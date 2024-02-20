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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table ->text('identificacion');
            $table ->text('nom_ape');
            $table ->date('fecha_nac');
            $table ->text('tipo_sangre');
            $table ->text('ciudad');
            $table ->text('telefono');
            $table ->integer('rango');
            $table ->integer('dependencia');
            $table ->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
