<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Capsule\CapsuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(["prefix"=>"v0.1"], function(){
    Route::group(["middleware"=> "auth:api"], function(){
        Route::group(["prefix"=> "public-wall"], function(){
            Route::post("/all",[CapsuleController::class,"getCapsules"]); //get capsules dynamically
        });
        Route::group(["prefix"=> "profile"], function(){
            // Route::get("/my-capsules","");

        });
    });
    Route::group(["prefix"=> "guest"], function(){
        Route::post("/login",[AuthController::class,"login"]);
        // Route::post("/register","");
    });

});

