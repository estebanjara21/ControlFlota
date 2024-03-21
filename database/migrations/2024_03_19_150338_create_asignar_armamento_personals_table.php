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
        Schema::create('asignar_armamento_personals', function (Blueprint $table) {
            $table->id();
            $table->integer('identificacion');
            $table->text('nombres_apellidos');
            $table->text('rango');
            $table->text('distrito');
            $table->text('tipo_arma');
            $table->text('descripcion_arma');
            $table->text('fecha_registro');
            $table->text('hora_registro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignar_armamento_personals');
    }
};
