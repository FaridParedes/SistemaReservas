<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gabinetes extends Model
{
    use HasFactory;

    protected $table = "gabinetes";
    protected $primaryKey = "idGabinetes";
    protected $fillable = ['idLaboratorios', 'idMaterialGastable'];
}
