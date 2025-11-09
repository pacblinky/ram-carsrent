<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // optional
            $table->string('video_path'); // store local path or URL
            $table->string('thumbnail')->nullable(); // preview image
            $table->boolean('is_active')->default(true); // toggle for slideshow
            $table->integer('order')->default(0); // for slide order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
