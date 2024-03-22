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
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id();
            $table->text('id_vehiculo');
            $table->text('estado');

            $table->text('solicitante');
            $table->text('gasolinera');
            $table->text('galones_combustible');
            $table->dateTime('fecha_hora');
            $table->integer('kilometraje_actual');
            $table->dateTime('fecha_solicitud');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combustibles');
    }
};
