<?php

namespace App\Services;

use App\Models\Capsule;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Reference\Reference;
use function Symfony\Component\Clock\now;
use Stevebauman\Location\Facades\Location;

class CapsuleService
{  
   // static function getPublic(){
   //  $capules = Capsule::where("security","public")->whereDate("reveal_at", "<=" ,now())->orderByDesc('reveal_at')->get();
   //  return $capules;
   // }
   // static function getByRange(Request $request){
   //    $capules = Capsule::where('security','public')->whereBetween('reveal_at',[$request->start, $request->end])->orderByDesc('reveal_at')->get();
   //    return $capules;
   // }
   static function getPublic(Request $request){
      $logic = Capsule::with(['user:id,username','mood:id,value'])
      ->where("security","public");
      if($request->filled(['start','end'])){ // make sure on both that they exist first 
         $logic->whereBetween('reveal_at',[$request->start, $request->end]);
      }else{
         $logic->where('reveal_at', '<=', Carbon::now('Asia/Beirut'));
      }
      $capsules = $logic->orderByDesc('reveal_at')->get()
      ->map(function ($capsule){
         return [
            'id'=>$capsule->id,
            'user'=>$capsule->user->username,
            'mood'=>$capsule->mood->value,
            'title'=>$capsule->title,
            'message'=>$capsule->message,
            'emoji'=>$capsule->emoji,
            'security'=>$capsule->security,
            'tags'=>json_decode($capsule->tags),
            'image_path'=>$capsule->image_path,
            'audio_path'=>$capsule->audio_path,
            'file_path'=>$capsule->file_path,
            'location'=>$capsule->location,
            'reveal_at'=>$capsule->reveal_at,
            'created_at'=>$capsule->created_at
         ];
      });
      return $capsules;
   }
   public static function fileSave($file,$type){
      // only extracted extensio by ai 
       // Extract mime type and extension
      $mimeType = explode(';', explode(':', $file)[1])[0];
      $extension = explode('/', $mimeType)[1];
      
      $fileData = base64_decode(explode(',', $file)[1]);            
      $filename =`capsules/{$type}/`.Str::random(40).'.'.$extension;
      Storage::disk('public')->put($filename, $fileData);
      return $filename;
   }
   static function createCapsule(Request $request){
      $capsule = new Capsule;
      $capsule->user_id = Auth::id(); 
      $capsule->mood_id = $request->mood_id;
      $capsule->title = $request->title;
      $capsule->message = $request->message;
      $capsule->emoji = $request->emoji;
      $capsule->security = $request->security;
      $capsule->tags = $request->tags;
      $capsule->surprise = $request->surprise;
     
      $capsule->location = null;
      $capsule->reveal_at = $request->reveal_at;
      
      $capsule->image_path = self::fileSave ($request->image_path,"images");;
      $capsule->audio_path = self::fileSave($request->audio_path, "audio");
      $capsule->file_path = self::fileSave($request->file_path,"files");
      $capsule->save();

      // it is taking too much time so we separate it save first with location null and in the background change the location
      if($publicIp = Http::get('https://api.ipify.org')->body()){
         $position = Location::get($publicIp)->countryName;
         $capsule->location = $position;
         $capsule->save();
      }
      return $capsule;
   }
  
   static function getUserCapsules(Request $request){
      $capsules= Capsule::with(['mood:id,value'])
      ->where("user_id",Auth::id())
      ->where("surprise",false)
      ->orderByDesc('reveal_at')->get()
      ->map(function ($capsule){
         return [
            'id'=>$capsule->id,
            'user'=>"You",
            'mood'=>$capsule->mood->value,
            'title'=>$capsule->title,
            'message'=>$capsule->message,
            'emoji'=>$capsule->emoji,
            'security'=>$capsule->security,
            'tags'=>json_decode($capsule->tags),
            'image_path'=>$capsule->image_path,
            'audio_path'=>$capsule->audio_path,
            'file_path'=>$capsule->file_path,
            'location'=>$capsule->location,
            'reveal_at'=>$capsule->reveal_at,
            'revealed'=> ($capsule->reveal_at <= Carbon::now(timezone: 'Asia/Beirut')),
            'created_at'=>$capsule->created_at,
            
         ];
      });
      
      return $capsules;
   }

   static function deleteCapsule(Request $request,$id){
      $deleted = Capsule::where('id',$id)->where('user_id',Auth::id())->delete();
      return $deleted;
   }
}