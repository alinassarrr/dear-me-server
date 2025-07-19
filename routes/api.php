<?php

use App\Http\Controllers\Capsule\CapsuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/all",[CapsuleController::class,"getCapsules"]);

