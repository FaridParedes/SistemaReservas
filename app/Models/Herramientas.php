<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramientas extends Model
{
    use HasFactory;

    protected $table = "herramientas";
    protected $primaryKey = "idHerramientas";
    protected $fillable = [
        'nombre', 'fotografia', 'descripcion', 
        'stock', 'marca', 'idEstadoHerramientas',
    ];
}
