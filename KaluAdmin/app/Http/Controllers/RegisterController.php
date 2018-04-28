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
            'between' => 'El :attribute debe estar entre :min - :max.'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|between:6,10|alpha_num',
            'password_confirm' => 'required|same:password'
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
              'error' => true,
              'messages' => $messages
            ]);
        }

    	$input = $request->all();
    	$input['password'] = Hash::make($input['password']);
    	User::create($input);
        return response()->json(['error' => false]);
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
