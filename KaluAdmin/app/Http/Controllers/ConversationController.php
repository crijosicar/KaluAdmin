<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Conversaciones;
use DB;
use stdClass;
use Carbon\Carbon;
use Storage;
use Google\Cloud\Speech\SpeechClient;
use Ixudra\Curl\Facades\Curl;

class ConversationController extends Controller {

    private $googleSpeech;
    private $googleCredentials;
    private $watsonAssistantBase;
    private $watsonAssistantWorkspace;
    private $watsonAssistantVersion;
    private $watsonAssistantUsername;
    private $watsonAssistantPassword;

    public function __construct() {
        $this->googleCredentials = json_decode(Storage::disk('audios')->get('kalu.credentials.json'), true);
        $this->googleSpeech = new SpeechClient([
            'languageCode' => 'es-CO',
            'keyFile' =>  $this->googleCredentials
        ]);
        $this->watsonAssistantBase = env('API_WATSON_ASSIANT_BASE');
        $this->watsonAssistantWorkspace = env('API_WATSON_ASSIANT_WORKSPACE');
        $this->watsonAssistantVersion = env('API_WATSON_ASSIANT_VERSION');
        $this->watsonAssistantUsername = env('API_WATSON_ASSIANT_USERNAME');
        $this->watsonAssistantPassword = env('API_WATSON_ASSIANT_PASSWORD');
    }

    public function sendMessage(Request $request) {
        $messages = [
            'required' => 'El :attribute es requerido.',
            'date' => 'El :attribute debe tener el formato de fecha.'
        ];

        $validations = [
            'user_id' => 'required',
            'mensaje' => 'required'
        ];

        $validator = Validator::make($request->all(), $validations, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
              'error' => true,
              'messages' => $messages
            ]);
        }

        $payload = $request->all();

        $now = new Carbon();
        $now->setTimezone('America/Bogota');
        $payload['fecha_creacion'] = $now->toDateTimeString();
        $result = Conversaciones::create($payload);
        return response()->json([
          'error' => false,
          'result' => $result
        ]);
    }

    public function sendAudioMessage(Request $request) {

        $messages = [
            'required' => 'El :attribute es requerido.',
        ];

        $validations = [
            'audio' => 'required',
            'is_bot' => 'required'
        ];

        $niceNames = array(
            'audio' => 'audio',
            'is_bot' => 'bot',
        );

        $validator = Validator::make($request->all(), $validations, $messages, $niceNames);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
              'error' => true,
              'messages' => $messages
            ]);
        }
        $storagePath = Storage::disk('audios')->getDriver()->getAdapter()->getPathPrefix();
        $options = [
            'encoding' => 'LINEAR16',
            'sampleRateHertz' => 16000,
        ];
        $urlAudio = $storagePath . $request->input('audio');
        $operation = $this->googleSpeech->beginRecognizeOperation(fopen($urlAudio, 'r'), $options);

        $isComplete = $operation->isComplete();
        while (!$isComplete) {
            sleep(1);
            $operation->reload();
            $isComplete = $operation->isComplete();
        }

        $result = $operation->results();

        if(count($result)){
          $alternative = $result[0]->topAlternative();
          $transcript = $alternative['transcript'];
          $wtResponse = $this->getResponseFromWatson($transcript);
          return response()->json(["error" => false, "message" => $wtResponse]);
        } else {
          return response()->json(["error" => true, "message" => "Audio no reconocido"]);
        }
    }

    public function getResponseFromWatson($message = "") {
      $textobj = new stdClass();
      $textobj->text = $message;
      $response = Curl::to($this->watsonAssistantBase . "/v1/workspaces/" . $this->watsonAssistantWorkspace . "/message?version=" . $this->watsonAssistantVersion )
        ->withData( array( 'input' =>  $textobj) )
        ->asJson( true )
        ->withHeader('Content-Type: application/json')
        ->withOption('HTTPAUTH', CURLAUTH_BASIC)
        ->withOption('USERPWD', "$this->watsonAssistantUsername:$this->watsonAssistantPassword")
        ->post();
      return $response;
    }

    public function uploadAudio(Request $request){
      if($request->hasFile("audio")){
        $uniqid = uniqid();
        $fileName = $uniqid . "audio.mp4";
        Storage::disk('audios')->put($fileName, file_get_contents($request->file('audio')->getRealPath()));
        $storagePath = Storage::disk('audios')->getDriver()->getAdapter()->getPathPrefix();
        $this->convertAudioToLinear16($storagePath . $fileName, $storagePath . $uniqid."audio.pcm");
        sleep(5);
        return response()->json(["error" => false, "path_audio" => $fileName]);
      }
      return response()->json(["error" => true, "message" => "No hay archivo"]);
    }

    public function convertAudioToLinear16($source_filename, $output_filename){
      $command = "ffmpeg -y -i $source_filename -r 16 -filter:v 'setpts=0.25*PTS' -acodec pcm_s16le -f s16le -ac 1 -ar 16000 $output_filename 2>&1";
      $output = shell_exec($command);
      return $output;
    }

    public function getMessagesXUser(Request $request) {
        $messages = [
            'required' => 'El :attribute es requerido.'
        ];

        $validations = [
            'user_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $validations, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
              'error' => true,
              'messages' => $messages
            ]);
        }

        $payload = $request->all();

        $result = DB::table('conversaciones')
                    ->join('users', 'users.id', '=', 'conversaciones.user_id')
                    ->where('conversaciones.user_id', $payload['user_id'])
                    ->select('conversaciones.id',
                            'conversaciones.user_id',
                            'conversaciones.mensaje',
                            'conversaciones.fecha_creacion',
                            'conversaciones.is_bot',
                            'users.id',
                            'users.email',
                            'users.name')
                    ->orderBy('conversaciones.created_at', 'desc')
                    ->paginate(15);

        $resultAux = new stdClass();
        $resultAux->perPage = $result->perPage();
        $resultAux->currentPage = $result->currentPage();
        $resultAux->total = $result->total();
        $resultAux->lastPage = $result->lastPage();
        $resultAux->items = array();

        foreach ($result->items() as $key => $value){
          $item = new stdClass();
          $item->createdAt = $value->fecha_creacion;
          $item->text = $value->mensaje;
          $item->isBot = $value->is_bot;
          $item->userID = $value->user_id;
          $user = new stdClass();
          $user->email = $value->email;
          $user->name = $value->name;
          $item->user = $user;
          array_push($resultAux->items, $item);
        }

        return response()->json($resultAux);
    }

}
