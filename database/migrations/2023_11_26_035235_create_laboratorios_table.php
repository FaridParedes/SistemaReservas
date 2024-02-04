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
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id('idLaboratorios');
            $table->string('nombreLaboratorio', 150);
            $table->string('fotografia', 150);
            $table->text('descripcion');
            $table->unsignedBigInteger('idEstadoLaboratorios');
            $table->foreign('idEstadoLaboratorios')->references('idEstadoLaboratorios')->on('estado_laboratorios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorios');
    }
};
