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
        Schema::create('diasreserva', function (Blueprint $table) {
            $table->unsignedBigInteger('idDia');
            $table->unsignedBigInteger('idReserva');
            $table->foreign('idReserva')->references('idReservas')->on('reservas');
            $table->foreign('idDia')->references('idDias')->on('dias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diasreserva');
    }
};
