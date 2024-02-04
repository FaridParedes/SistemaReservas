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
        Schema::create('equiporeserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEquipo');
            $table->unsignedBigInteger('idReserva');
            $table->unsignedBigInteger('idSistemaOperativo');
            $table->integer('cantidad');
            $table->foreign('idReserva')->references('idReservas')->on('reservas');
            $table->foreign('idEquipo')->references('idEquipos')->on('equipos');
            $table->foreign('idSistemaOperativo')->references('idSistemasOperativos')->on('sistemas_operativos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equiporeserva');
    }
};
