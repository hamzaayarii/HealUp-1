<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Supprimez la table existante si elle existe
        Schema::dropIfExists('repas');
        
        // Créez la nouvelle table complète
        Schema::create('repas', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('type_repas', ['petit-dejeuner', 'dejeuner', 'diner', 'collation']);
            $table->dateTime('date_consommation');
            $table->unsignedBigInteger('user_id');
            $table->float('calories_total')->default(0);
            $table->float('proteines_total')->default(0);
            $table->float('glucides_total')->default(0);
            $table->float('lipides_total')->default(0);
            $table->timestamps();

            // Clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repas');
    }
};
