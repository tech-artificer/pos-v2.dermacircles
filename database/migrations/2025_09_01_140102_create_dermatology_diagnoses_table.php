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
        Schema::create('dermatology_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Name of the condition (e.g., "Eczema")
            $table->text('description')->nullable(); // Description of the condition
            $table->text('symptoms')->nullable(); // Common symptoms
            $table->softDeletes();  
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dermatology_diagnoses');
    }
};
