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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('idEquipos');
            $table->string('nombre', 150);
            $table->string('fotografia', 150);
            $table->string('espacio_disponible', 150);
            $table->string('ram', 150);
            $table->string('procesador', 150);
            $table->unsignedBigInteger('idEstadoEquipos');
            $table->foreign('idEstadoEquipos')->references('idEstadoEquipos')->on('estado_equipos');
            $table->unsignedBigInteger('idSistemasOperativos');
            $table->foreign('idSistemasOperativos')->references('idSistemasOperativos')->on('sistemas_operativos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
