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
        Schema::create('spectacles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salle_id')->constrained('salle')->onDelete('cascade');
            $table->string('nom_spectacle')->nullable(); // Optional name
            $table->date('date_spectacle');
            $table->time('heure_spectacle');
            $table->decimal('prix', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spectacles');
    }
};
