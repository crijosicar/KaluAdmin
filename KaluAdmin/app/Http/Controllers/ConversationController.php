<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Conversaciones;
use DB;
use stdClass;
use Carbon\Carbon;

class ConversationController extends Controller {

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
