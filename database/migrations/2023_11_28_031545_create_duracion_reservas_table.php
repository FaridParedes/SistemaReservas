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
        Schema::create('duracion_reservas', function (Blueprint $table) {
            $table->id('idDuracionReservas');
            $table->unsignedBigInteger('idLaboratorios');
            $table->unsignedBigInteger('idReserva');
            $table->date('fecha');
            $table->time('horaInicio');
            $table->time('horaFinal');
            $table->foreign('idLaboratorios')->references('idLaboratorios')->on('laboratorios');
            $table->foreign('idReserva')->references('idReservas')->on('reservas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duracion_reserva');
    }
};
