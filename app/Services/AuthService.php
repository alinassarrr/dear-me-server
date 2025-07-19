<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
