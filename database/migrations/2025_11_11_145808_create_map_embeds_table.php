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
        Schema::create('map_embeds', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // 'about' or 'contact'
            $table->text('embed_code'); // The <iframe ...>
            $table->integer('sort_order')->default(0); // For reordering
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_embeds');
    }
};
