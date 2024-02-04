<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoHerramientas extends Model
{
    use HasFactory;

    protected $table = "estado_herramientas";
    protected $primaryKey = "idEstadoHerramientas";
    protected $fillable = ['estado'];
}
