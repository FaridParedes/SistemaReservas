<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoLaboratorios extends Model
{
    use HasFactory;

    protected $table = "estado_laboratorios";
    protected $primaryKey = "idEstadoLaboratorios";
    protected $fillable = ['estado'];
}
