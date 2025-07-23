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
    protected $dates = [
    'reveal_at',
    'created_at',
    'updated_at'
];
    protected $dateFormat = 'Y-m-d H:i:s'; // Prevent UTC conversion

    function user(){
        return $this->belongsTo(User::class);
    } 
    function mood(){
        return $this->belongsTo(Mood::class);
    }
}
