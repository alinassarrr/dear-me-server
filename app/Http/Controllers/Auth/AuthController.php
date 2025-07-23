<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginValidationRequest;
use App\Http\Requests\RegisterValidationRequest;
use App\Services\AuthService;
use Exception;

class AuthController extends Controller
{   
    public function login(LoginValidationRequest $request){
        try{
            $user = AuthService::login($request);
            if($user){
                return $this->responseJSON($user);
            }
            return $this->responseJSON("Wrong Credentials",401,"failed");
        }catch(Exception $e){
            return $this->responseJSON($e->getMessage(),400,"error");
        }

    }
    
    public function register(RegisterValidationRequest $request){
        try{
            $user = AuthService::register($request);
            return $this->responseJSON($user); 
        }
        catch(Exception $e){
            return $this->responseJSON($e->getMessage(),400,"error");
        }
    }
}
