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
        Schema::create('repas_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repas_id')->constrained('repas')->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
            $table->decimal('quantite', 8, 2)->default(0); // Quantity in grams
            $table->decimal('calories_calculees', 8, 2)->default(0); // Calculated calories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repas_ingredients');
    }
};
