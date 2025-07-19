<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    static function login(Request $request){
        $request->validate([
            'email'=>['required','string','email'],
            'password'=>['required','string']
        ]);
        $credentials = $request->only('email','password');
    
        $token = Auth::attempt($credentials);
        if(!$token){
            return null;
        }
        $user =Auth::user();
        $user->token = $token;
        return $user;
    }

    static function register(Request $request){
        $request->validate([
            "email"=>["required","string","email"],
            "password"=>["required","string"],
            "username"=> ["required","string"]
        ]);
        $user = new User; 
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->save();

        $token = Auth::login($user);
        $user->token = $token;
        return $user;
    }
}
