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
        Schema::create('registro_dependencias', function (Blueprint $table) {
            $table->id();
            $table ->integer('id_provincia');
            $table ->integer('id_distrito');
            $table ->integer('id_parroquia');
            $table ->integer('circuito');
            $table ->integer('id_subcircuito');
            $table ->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_dependencias');
    }
};
