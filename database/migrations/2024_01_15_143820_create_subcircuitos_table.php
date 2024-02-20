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
        Schema::create('subcircuitos', function (Blueprint $table) {
            $table->id();
            $table ->text('descripcion');
            $table ->integer('estado');
             $table ->text('codigo_subcircuito');
            $table->unsignedBigInteger('id_circuito');
            $table->timestamps();
            // Restricción de clave foránea
            $table->foreign('id_circuito')->references('id')->on('circuitos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcircuitos');
    }
};
