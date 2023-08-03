<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->validateToken($request);

        $user = User::all();
    
        return response()->json([
            '   data'=> $user            
            ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = $request->user()->createToken($request->token_name);
 
        return ['token' => $token->plainTextToken];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = $request->User('api');
    
        if(!$user){
            return response()->json(['error' => 'Unautorized'], status: 401);
        }
    
        return response()->json([
                'data'=> $user            
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    private function validateToken($token)
    {
        $user = $token->User('api');
    
        if(!$user){
            return response()->json(['error' => 'Unautorized'], status: 401);
        }

        return $user;
    }
   
}
