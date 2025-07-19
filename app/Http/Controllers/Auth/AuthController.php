<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{   
    public function login(Request $request){
    $user = AuthService::login($request);
    if($user){
        return $this->responseJSON($user);
    }
    return $this->responseJSON("Wrong Credentials",401,"failed");
    }

    public function register(Request $request){
        try{
            $user = AuthService::register($request);
            if($user){
                return $this->responseJSON($user);
            }
            return $this->responseJSON("Failed to create an account",400,"failed");
        }
        catch(Exception $e){
            return $this->responseJSON($e->getMessage(),400,"error");
        }
    }
}
