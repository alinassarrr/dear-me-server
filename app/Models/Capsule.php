<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'mood_id',
        'title',
        'message',
        'emoji',
        'security',
        'tags',
        'surprise',
        'image_path',
        'audio_path',
        'file_path',
        'ip_address',
        'location',
        'reveal_at'
    ];
    function user(){
        return $this->belongsTo(User::class);
    } 
    function mood(){
        return $this->belongsTo(Mood::class);
    }
}
