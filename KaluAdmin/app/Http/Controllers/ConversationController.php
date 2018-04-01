<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class ConversationController extends Controller
{ 
    public function sendMessage(Request $request)
    {
    	$input = $request->all();
    	$user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $user]);
    }
}
