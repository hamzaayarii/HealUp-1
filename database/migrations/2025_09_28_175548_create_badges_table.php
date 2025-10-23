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
        Schema::create('badges', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('description');
        $table->string('icon')->nullable();
        $table->integer('required_points')->default(0);
        $table->string('type'); // challenge, participation, etc.
        $table->json('criteria')->nullable(); // Critères spécifiques
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });

    // Removed user_badges table creation to avoid duplication. Now handled in a dedicated migration.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
        // No need to drop user_badges here, handled in its own migration.
    }
};
