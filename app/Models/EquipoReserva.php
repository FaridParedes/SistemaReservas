<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoReserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "equiporeserva";
    protected $fillable = ['id','idEquipo', 'idReserva','cantidad','idSistemaOperativo'];
}
