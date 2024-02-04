<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoMaterialGastable extends Model
{
    use HasFactory;

    protected $table = "estado_materialGastable";
    protected $primaryKey = "idEstadoMaterialGastable";
    protected $fillable = ['estado'];
}
