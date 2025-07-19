<?php

namespace App\Http\Controllers\Capsule;

use App\Http\Controllers\Controller;
use App\Models\Capsule;
use App\Services\CapsuleService;
use App\Traits\ResponseService;
use Illuminate\Http\Request;
use Exception;

class CapsuleController extends Controller
{
    function getCapsules(Request $request){
        try{
            $capsules = CapsuleService::getPublic($request);   
            return $this->responseJSON($capsules);
        }
        catch(Exception $e){
            return $this->responseJSON($e->getMessage(), 500,"failed");
        }
    }
}