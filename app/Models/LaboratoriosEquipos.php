<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriosEquipos extends Model
{
    use HasFactory;

    protected $table = "laboratorios_equipos";
    protected $primaryKey = "idLaboEquipos";
    protected $fillable = ['idLaboratorios', 'idEquipos'];
}
