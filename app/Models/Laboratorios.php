<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorios extends Model
{
    use HasFactory;
    
    protected $table = "laboratorios";
    protected $primaryKey = "idLaboratorios";
    protected $fillable = ['nombreLaboratorio', 'fotografia', 'descripcion', 'idEstadoLaboratorios'];
}
