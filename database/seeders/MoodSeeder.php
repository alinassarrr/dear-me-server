<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods=[
            ['value'=>'happy','text'=>'😊 Happy & Content'],
            ['value'=>'sad','text'=>'😢 Sad & Reflective'],
            ['value'=>'excited','text'=>'🤩 Excited & Inspired'],
            ['value'=>'calm','text'=>'😌 Peaceful & Calm'],
            ['value'=>'thoughtful','text'=>'🤔 Thoughtful & Curious'],
        ];

        foreach ($moods as $mood) {
            Mood::create($mood);
        }
    }
}
