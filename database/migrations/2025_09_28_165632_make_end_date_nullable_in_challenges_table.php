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
    Schema::table('challenges', function (Blueprint $table) {
        $table->date('end_date')->nullable()->change(); // Allows NULL values
    });
}
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            //
        });
    }
};
