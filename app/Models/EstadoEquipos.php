<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEquipos extends Model
{
    use HasFactory;

    protected $table = "estado_equipos";
    protected $primaryKey = "idEstadoEquipos";
    protected $fillable = ['estado'];
}
