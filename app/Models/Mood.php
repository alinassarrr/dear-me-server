<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    //
    use HasFactory;



     function capsules(){
        return $this->hasMany(Capsule::class);
    } 

}
