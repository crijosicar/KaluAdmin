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
            'required' => 'El campo :attribute es requerido.',
            'unique' => 'El :attribute ya ha sido tomado.',
            'same'    => 'El campo :attribute y :other deben coincidir.',
            'between' => 'El campo :attribute debe estar entre :min - :max.',
            'email' => 'El campo :attribute debe tener el formato: ejemplo@dominio.com.',
            'alpha_num' => 'El campo :attribute puede contener solo números y letras.'
        ];

        $niceNames = array(
            'email' => 'correo electrónico',
            'name' => 'nombre',
            'password' => 'contraseña',
            'password_confirm' => 'confirmación de contraseña'
        );

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|between:6,10|alpha_num',
            'password_confirm' => 'required|same:password'
        ], $messages, $niceNames);

        if ($validator->fails()) {
            $messages = $validator->messages();
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

    public function getUserByFBID(Request $request){
        $messages = [
            'required' => 'El campo :attribute es requerido.'
        ];

        $niceNames = array(
            'facebook_id' => 'ID de facebook'
        );

        $validator = Validator::make($request->all(), [
            'facebook_id' => 'required'
        ], $messages, $niceNames);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
              'error' => true,
              'messages' => $messages
            ]);
        }

        $payload = $request->all();

        $user = User::where('facebook_id', $payload['facebook_id'])->first();
        return response()->json(['error' => false, 'user' => $user]);
    }
}
