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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string('numero_reservation')->unique();
            // $table->foreignId('salle_id')->constrained('salle')->onDelete('cascade'); // Removed
            $table->foreignId('spectacle_id')->constrained('spectacles')->onDelete('cascade'); // Added
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->date('date_reservation'); // Removed
            // $table->time('heure_debut'); // Removed
            // $table->decimal('prix', 8, 2); // Removed
            $table->integer('nombre_personnes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
