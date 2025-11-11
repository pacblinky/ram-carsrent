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
        Schema::table('map_embeds', function (Blueprint $table) {
            $table->string('location_name')->nullable()->after('embed_code');
            $table->string('google_maps_link')->nullable()->after('location_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('map_embeds', function (Blueprint $table) {
            //
        });
    }
};
