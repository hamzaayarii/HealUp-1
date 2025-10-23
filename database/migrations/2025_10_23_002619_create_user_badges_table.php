<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('user_badges')) {
            Schema::create('user_badges', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('badge_id')->constrained()->onDelete('cascade');
                $table->timestamp('earned_at')->useCurrent();
                $table->json('progress_data')->nullable();
                $table->timestamps();

                $table->unique(['user_id', 'badge_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('user_badges');
    }
};