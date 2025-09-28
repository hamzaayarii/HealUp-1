<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_habits', function (Blueprint $table) {
            $table->decimal('target_value', 8, 2)->default(1.00)->after('habit_id');
            $table->string('unit', 50)->default('times')->after('target_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_habits', function (Blueprint $table) {
            $table->dropColumn(['target_value', 'unit']);
        });
    }
};
