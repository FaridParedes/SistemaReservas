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
        Schema::create('materialreserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMaterial');
            $table->unsignedBigInteger('idReserva');
            $table->integer('cantidad');
            $table->foreign('idReserva')->references('idReservas')->on('reservas');
            $table->foreign('idMaterial')->references('idMaterialGastable')->on('material_gastable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materialreserva');
    }
};
