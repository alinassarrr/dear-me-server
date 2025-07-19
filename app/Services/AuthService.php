<?php

namespace App\Services;

use App\Http\Requests\LoginValidationRequest;
use App\Http\Requests\RegisterValidationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    static function login(LoginValidationRequest $request){
        $request->validated();
        $credentials = $request->only('email','password');
    
        $token = Auth::attempt($credentials);
        if(!$token){
            return null;
        }
        $user =Auth::user();
        $user->token = $token;
        return $user;
    }

    static function register(RegisterValidationRequest $request){
        $request->validated();
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
