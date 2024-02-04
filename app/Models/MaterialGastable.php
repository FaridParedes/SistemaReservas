<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialGastable extends Model
{
    use HasFactory;

    protected $table = "material_gastable";
    protected $primaryKey = "idMaterialGastable";
    protected $fillable = ['nombre', 'fotografia', 'descripcion', 'idTipos_cantidades',
    'stock', 'idEstadoMaterialGastable'];
}
