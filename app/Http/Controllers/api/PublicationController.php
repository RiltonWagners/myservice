<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function publicationsUser(Request $request)
    {
        $user = $this->validateToken($request);

        $publications = Publication::where('id_user', '=', $user->id)->orderBy('id', 'DESC')->paginate(10);
        
        if(count($publications) == 0){
            return response()->json(['data' => 'No results were found'], status: 401);
        }

        return response()->json([
                'data'=> $publications            
            ]);
    }

    public function publicationUser(Request $request)
    {
        $user = $this->validateToken($request);

        $publication = Publication::where('id', '=', $request->id)->get();

        if(count($publication) == 0){
            return response()->json(['data' => 'Not found'], status: 401);
        }

        return response()->json([
                'data'=> $publication
            ]);
    }

    public function publications(Request $request)
    {
        $user = $this->validateToken($request);

        $publications = Publication::orderBy('id', 'DESC')->paginate(10);

        if(count($publications) == 0){
            return response()->json(['data' => 'No results were found'], status: 401);
        }

        return response()->json([
                'data'=> $publications
            ]);
    }

    public function publication(Request $request)
    {
        $user = $this->validateToken($request);

        $publication = Publication::where('id', '=', $request->id)->get();

        if(count($publication) == 0){
            return response()->json(['data' => 'Not found'], status: 401);
        }

        return response()->json([
                'data'=> $publication
            ]);
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
