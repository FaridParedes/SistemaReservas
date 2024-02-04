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
        Schema::create('laboratorios_equipos', function (Blueprint $table) {
            $table->id('idLaboEquipos');
            $table->unsignedBigInteger('idLaboratorios');
            $table->foreign('idLaboratorios')->references('idLaboratorios')->on('laboratorios');
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
        Schema::dropIfExists('laboratorios_equipos');
    }
};
