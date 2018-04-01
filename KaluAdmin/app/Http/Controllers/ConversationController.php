<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Conversaciones;

class ConversationController extends Controller
{ 
    public function sendMessage(Request $request)
    {
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
}
