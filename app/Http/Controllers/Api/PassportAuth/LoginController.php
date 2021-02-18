<?php

namespace App\Http\Controllers\Api\PassportAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function login (Request $request) {

        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ( Auth::attempt($login) ) {

            $token = Auth::user()->createToken('token')->accessToken;
            return response(['user' => Auth::user(), 'token' => $token]);

        } else {

            return response(['message' => 'Inavlid Credentials']);

        }
    }
}
