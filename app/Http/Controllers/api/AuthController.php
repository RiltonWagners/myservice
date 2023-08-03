<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
    
        if(!$token = auth(guard:'api')->attempt($credentials)){
            return response()->json(['error' => 'Unautorized'], status: 401);
        }
    
        return $this->respondWithToken($token);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'data'=>[
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth(guard:'api')->factory()->getTTL()*60
            ]
        ]);
    }
}
