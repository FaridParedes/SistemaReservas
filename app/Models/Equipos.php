<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    use HasFactory;

    protected $table = "equipos";
    protected $primaryKey = "idEquipos";
    protected $fillable = [
        'nombre', 'fotografia',
        'sistema_operativo', 'espacio_disponible',
        'ram', 'procesador', 'idEstadoEquipos',
        'idSistemasOperativos'
    ];
}
