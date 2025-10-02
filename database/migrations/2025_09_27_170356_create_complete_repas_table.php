<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop repas_ingredients table first to remove foreign key constraint
        Schema::dropIfExists('repas_ingredients');
        
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
        
        // Recreate repas_ingredients table
        Schema::create('repas_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repas_id')->constrained('repas')->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
            $table->decimal('quantite', 8, 2)->default(0); // Quantity in grams
            $table->decimal('calories_calculees', 8, 2)->default(0); // Calculated calories
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repas');
    }
};
