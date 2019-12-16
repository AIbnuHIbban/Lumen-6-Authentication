<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function show($id){
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'status'    => 'success',
                'pesan'     => 'GET data User',
                'data'      => $user 
            ], 200);
        }else{
            return response()->json([
                'status'    => 'failed',
                'pesan'     => 'Not GET data User',
                'data'      => '' 
            ], 404);
        }
    }
}
