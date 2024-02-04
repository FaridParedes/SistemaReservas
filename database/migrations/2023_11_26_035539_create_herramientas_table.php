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
        Schema::create('herramientas', function (Blueprint $table) {
            $table->id('idHerramientas');
            $table->string('nombre', 150);
            $table->string('fotografia', 150);
            $table->string('descripcion');
            $table->string('marca');
            $table->unsignedBigInteger('idEstadoHerramientas');
            $table->foreign('idEstadoHerramientas')->references('idEstadoHerramientas')->on('estado_herramientas');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herramientas');
    }
};
