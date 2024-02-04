<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriosHerramientas extends Model
{
    use HasFactory;

    protected $table = "laboratorios_herramientas";
    protected $primaryKey = "idLaboHerramientas";
    protected $fillable = ['idLaboratorios', 'idHerramientas'];
}
