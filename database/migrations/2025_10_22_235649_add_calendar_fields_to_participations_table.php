<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->dateTime('last_checkin')->nullable()->after('completed_at');
            $table->integer('checkin_count')->default(0)->after('last_checkin');
            $table->json('checkin_history')->nullable()->after('checkin_count');
        });
    }

    public function down()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->dropColumn(['last_checkin', 'checkin_count', 'checkin_history']);
        });
    }
};
