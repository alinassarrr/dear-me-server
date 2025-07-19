<?php

namespace App\Services;

use App\Models\Capsule;
use DateTime;
use Illuminate\Http\Request;
use League\CommonMark\Reference\Reference;
use function Symfony\Component\Clock\now;

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
      $logic = Capsule::where("security","public");
      if($request->filled(['start','end'])){ // make sure on both that they exist first 
         $logic->whereBetween('reveal_at',[$request->start, $request->end]);
      }else{
         $logic->whereDate("reveal_at", "<=" ,now());
      }
      $capsules = $logic->orderByDesc('reveal_at')->get();
      return $capsules;
   }
}