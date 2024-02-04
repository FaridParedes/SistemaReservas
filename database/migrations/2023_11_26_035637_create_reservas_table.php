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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('idReservas');
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users');
            $table->unsignedBigInteger('idModulos');
            $table->foreign('idModulos')->references('idModulos')->on('modulos');
            $table->unsignedBigInteger('idLaboratorios');
            $table->foreign('idLaboratorios')->references('idLaboratorios')->on('laboratorios');
            $table->unsignedBigInteger('idEstadoReserva');
            $table->foreign('idEstadoReserva')->references('idEstadoReserva')->on('estado_reservas');
            $table->date('fechaInicio');
            $table->date('fechaFinal');
            $table->time('horaInicio');
            $table->time('horaFinal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
