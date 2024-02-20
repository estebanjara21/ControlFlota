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
        Schema::create('asignar_personal_subcircuitos', function (Blueprint $table) {
            $table->id();
            $table ->integer('id_personal');
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
        Schema::dropIfExists('asignar_personal_subcircuitos');
    }
};
