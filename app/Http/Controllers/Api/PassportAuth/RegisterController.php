<?php

namespace App\Http\Controllers\Api\PassportAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function register(Request $request) {

        $valid = validator($request->only('email', 'name', 'password'), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

        if ( $valid->fails() ) {

            return response(['message' => 'Error happend']);

        } else {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken('token')->accessToken;

            return response(['user' => $user, 'token' => $token]);

        }


    }
}
