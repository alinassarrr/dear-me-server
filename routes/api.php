<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Capsule\CapsuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(["prefix"=>"v0.1"], function(){
    Route::group(["middleware"=> "auth:api"], function(){
        Route::group(["prefix"=> "public-wall"], function(){
            Route::post("/",[CapsuleController::class,"getCapsules"]); //get capsules dynamically
        });
        Route::group(["prefix"=> "create"], function(){
            Route::post("/", [CapsuleController::class,"createCapsule"]);
        });
        Route::group(["prefix"=>"profile"],function(){
            Route::get("/my-capsules",[CapsuleController::class,"getUserCapsules"]);
            Route::post("/delete/{id}",[CapsuleController::class,"deleteCapsule"]);
            
        });
    });
    Route::group(["prefix"=> "guest"], function(){
        Route::post("/login",[AuthController::class,"login"]);
        Route::post("/register",[AuthController::class,"register"]);
    });

});

