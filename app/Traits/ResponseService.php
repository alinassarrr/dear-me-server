<?php

namespace App\Traits;

trait ResponseService
{
    static function responseJSON($data,$status_code=200,$status="success"){
        return response()->json(["status"=>$status,"data"=>$data],$status_code);
    }
}
