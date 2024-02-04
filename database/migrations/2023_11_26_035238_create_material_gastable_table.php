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
        Schema::create('material_gastable', function (Blueprint $table) {
            $table->id('idMaterialGastable');
            $table->string('fotografia', 250);
            $table->string('nombre', 150);
            $table->text('descripcion');
            $table->unsignedBigInteger('idTipos_cantidades');
            $table->foreign('idTipos_cantidades')
            ->references('idTipos_cantidades')->on('tipos_cantidades');
            $table->double('stock');
            $table->unsignedBigInteger('idEstadoMaterialGastable');
            $table->foreign('idEstadoMaterialGastable')
            ->references('idEstadoMaterialGastable')->on('estado_materialGastable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_gastable');
    }
};
