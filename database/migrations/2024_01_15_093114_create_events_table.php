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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table ->integer('id_circuitos');
            $table ->integer('id_subcircuito');
            $table ->integer('tipo');
            $table ->text('descripcion');
            $table ->string('contactos');
            $table ->string('apellidos');
            $table ->string('nombres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
