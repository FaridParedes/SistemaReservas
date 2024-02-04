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
        Schema::create('comentariosreserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idReserva');
            $table->longText('comentario');
            $table->foreign('idReserva')->references('idReservas')->on('reservas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentariosreserva');
    }
};
