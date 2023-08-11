<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        $user = User::where('email',request('email'))->first();

        if($user && Hash::check(request('password'),$user->password)){
            $token = $user->createToken('react-app')->plainTextToken;

            return response()->json([
                'email'     => request('email'),
                'password'  => request('password'),
                'token'     => $token,
                'message'   => 'The credential are valid, login success.',
                'status'    => 200
            ]);

        }else{
            return response()->json([
                'email'     => request('email'),
                'password'  => request('password'),
                'message'   => 'The credential are invalid, login failed.',
                'status'    => 401
            ]);
        }
    }

    public function logout()
    {
        $userId = auth()->user()->id;
        $user   = User::find($userId);
        $user->tokens()->delete();
        return response()->json([
            'message'   => 'User Loggedout Successfully.',
            'status'    => 200
        ]);
    }
}
