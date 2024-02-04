<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramasEquipoModel extends Model
{
    use HasFactory;

    protected $table = "programas_equipo";
    protected $primaryKey = "idProgramas_equipos";
    protected $fillable = [
        'nombre_programa', 'idEquipos'
    ];
}
