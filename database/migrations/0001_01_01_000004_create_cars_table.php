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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('category');
            $table->string('fuel_type');
            $table->string('transmission');
            $table->unsignedTinyInteger('number_of_seats');
            $table->unsignedTinyInteger('number_of_doors');
            $table->decimal('price_per_day', 10, 2)->default(0);
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
