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
        Schema::create('daily_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_habit_id')->constrained('user_habits')->onDelete('cascade');
            $table->date('date');
            $table->decimal('value', 8, 2); // The progress value (e.g., 8 glasses, 30 minutes)
            $table->boolean('completed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            // Ensure unique daily progress per user habit
            $table->unique(['user_habit_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_progress');
    }
};
