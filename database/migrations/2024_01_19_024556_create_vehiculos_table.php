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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table ->text('tipo_vehiculo');
            $table ->text('placa');
            $table ->text('chasis');
            $table ->text('marca');
            $table ->text('modelo');
            $table ->text('motor');
            $table ->text('kilometraje');
            $table ->text('cilindraje');
            $table ->text('capcarga');
            $table ->integer('cappasejeros');
            $table ->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
