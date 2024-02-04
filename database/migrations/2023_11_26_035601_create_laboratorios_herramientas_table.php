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
        Schema::create('laboratorios_herramientas', function (Blueprint $table) {
            $table->id('idLaboHerramientas');
            $table->unsignedBigInteger('idLaboratorios');
            $table->unsignedBigInteger('idHerramientas');
            $table->foreign('idLaboratorios')->references('idLaboratorios')->on('laboratorios');
            $table->foreign('idHerramientas')->references('idHerramientas')->on('herramientas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorios_herramientas');
    }
};
