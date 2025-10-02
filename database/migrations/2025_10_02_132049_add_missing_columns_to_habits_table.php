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
        Schema::table('habits', function (Blueprint $table) {
            $table->enum('difficulty_level', ['easy', 'medium', 'hard'])->default('medium')->after('frequency');
            $table->integer('points_per_completion')->default(10)->after('difficulty_level');
            $table->string('icon')->nullable()->after('points_per_completion');
            $table->string('color')->nullable()->after('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            $table->dropColumn(['difficulty_level', 'points_per_completion', 'icon', 'color']);
        });
    }
};
