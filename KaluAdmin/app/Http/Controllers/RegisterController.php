<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use JWTAuth;
use Validator;

class RegisterController extends Controller{

    public function register(Request $request){
        $messages = [
            'required' => 'El :attribute es requerido.',
            'unique' => 'El :attribute debe ser único.',
            'same'    => 'El :attribute y :other deben coincidir.',
            'between' => 'El :attribute debe estar entre :min - :max.',
            'email' => 'El formato para :attribute debe ser: ejemplo@dominio.com.',
            'alpha_num' => 'El :attribute puede contener solo números y letras.'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|between:6,10|alpha_num',
            'password_confirm' => 'required|same:password'
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            dd($messages);
            return response()->json([
              'error' => true,
              'messages' => $messages
            ]);
        }

    	$input = $request->all();
    	$input['password'] = Hash::make($input['password']);
    	$response = User::create($input);
      $user = User::find($response->id);
      return response()->json(['error' => false, 'user' => $user]);
    }


    public function login(Request $request){
    	$input = $request->all();
    	if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
              'error' => true,
              'message' => 'Correo electrónico o contraseña incorrectos'
              ]);
        }
        return response()->json([
          'error' => false,
          'token' => $token
        ]);
    }


    public function getUserDetails(Request $request){
    	  $user = JWTAuth::toUser( $request->input('token'));
        return response()->json(['error' => false, 'user' => $user]);
    }


}
