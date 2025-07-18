<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

         Schema::create('moods', function (Blueprint $table) {
            $table->id();
            $table->string("value");
            $table->string("text");
            $table->timestamps();
        });

        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mood_id')->nullable()->constrained('moods')->onDelete('set null');
            $table->string('title');
            $table->date('reveal_date');
            $table->time('reveal_time');
            $table->text('message');
            $table->string('emoji');
            $table->enum('security',['private','public','unlisted']);
            $table->json('tags');
            $table->boolean('surprise');
            $table->string('image_path')->nullable();
            $table->string('audio_path')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');
    }
};
