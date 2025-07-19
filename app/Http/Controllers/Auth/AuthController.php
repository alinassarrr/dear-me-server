<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    public function login(Request $request){
    $user = AuthService::login($request);
    if($user){
        return $this->responseJSON($user);
    }
    return $this->responseJSON("Wrong Credentials",401,"error");
}
}
