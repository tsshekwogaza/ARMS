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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Landlord ID
            $table->string('title'); // e.g., "Sunrise Apartments, Plot 102 Gwarinpa"
            $table->string('rent_rate')->nullable();
            $table->string('type')->default('Residential');
            $table->string('address'); // e.g House 12, Aminu Kano Crescent, Wuse II
            $table->string('city')->default('Abuja');
            $table->string('unit')->nullable(); //e.g'3 Bedroom Flat'
            $table->string('image_url')->default('properties/home.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
