<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Conversaciones;
use DB;

class ConversationController extends Controller {

    public function sendMessage(Request $request) {
        $messages = [
            'required' => 'El :attribute es requerido.',
            'date' => 'El :attribute debe tener el formato de fecha.'
        ];

        $validations = [
            'user_id' => 'required',
            'mensaje' => 'required',
            'fecha_creacion' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $validations, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json($messages);
        }

        $payload = $request->all();
        $result = Conversaciones::create($payload);
        return response()->json($result);
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
            return response()->json($messages);
        }

        $payload = $request->all();
              
        $result = DB::table('conversaciones')
                    ->join('users', 'users.id', '=', 'conversaciones.user_id')
                    ->where('conversaciones.user_id', $payload['user_id'])
                    ->select('conversaciones.id', 
                            'conversaciones.mensaje', 
                            'conversaciones.fecha_creacion', 
                            'conversaciones.is_bot', 
                            'users.id',
                            'users.email',
                            'users.name')
                    ->paginate(30);
        
        //$result = Conversaciones::where('user_id', $payload['user_id'])->paginate(30);
        return response()->json($result);
    }

}
