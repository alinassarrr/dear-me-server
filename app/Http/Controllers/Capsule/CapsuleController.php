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
            return $this->responseJSON($e->getMessage(), 500,"error");
        }
    }

    function createCapsule(Request $request){
        try{
            $request->validate([
            'mood_id' => 'nullable|exists:moods,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'emoji' => 'required|string',
            'security' => 'required|in:private,public,unlisted',
            'tags' => 'required|json    ',
            'surprise' => 'required|boolean',
            'reveal_at' => 'required|date|after:now',
            'image_path' => 'nullable|string',
            'audio_path' => 'nullable|string',
            'file_path' => 'nullable|string',
    ]);
            $capsule = CapsuleService::createCapsule($request);
            return $this->responseJSON($capsule);
        }
        catch(Exception $e){
            return $this->responseJSON($e->getMessage(), 500,"error");
        }
    }
    

    function getUserCapsules(Request $request){
        try{
             $capsules = CapsuleService::getUserCapsules($request);
             return $this->responseJSON($capsules);
        }catch(Exception $e){
            return $this->responseJSON($e->getMessage(),400,"error");
        }
       
    }
    function deleteCapsule(Request $request,$id){
       $deleted = CapsuleService::deleteCapsule($request,$id);
       if(!$deleted){
        return $this->responseJSON("Failed to delete!",400,"failed");
       }
        return $this->responseJSON("Capsule deleted!");
    }
}