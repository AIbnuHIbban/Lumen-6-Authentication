<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        
    }

    public function register(Request $request){
        $username = $request->username;
        $password = Hash::make($request->password);

        $register = User::create([
            'username'      => $username,
            'password'      => $password
        ]);

        if ($register) {
            return response()->json([
                'status'    => 'success',
                'pesan'     => 'berhasil registrasi',
                'data'      => $register
            ], 201);
        }else{
            return response()->json([
                'status'    => 'failed',
                'pesan'     => 'gagal registrasi',
                'data'      => ''
            ], 400);
        }

    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if (Hash::check($password, $user->password)) {
            $apiToken = base64_encode(Str::random(45));

            $user->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'status'    => 'success',
                'pesan'     => 'berhasil login',
                'data'      => [
                    'user'      => $user,
                    'api_token' => $apiToken
                ]
            ]);
        }else{
            return response()->json([
                'status'    => 'failed',
                'pesan'     => 'gagal login',
                'data'      => ''
            ]);
        }
    }
}
