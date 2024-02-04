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
        Schema::create('programas_equipo', function (Blueprint $table) {
            $table->id('idProgramas_equipos');
            $table->string('nombre_programa');
            $table->unsignedBigInteger('idEquipos');
            $table->foreign('idEquipos')->references('idEquipos')->on('equipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas_equipo');
    }
};
