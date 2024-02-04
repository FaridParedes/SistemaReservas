<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = "reservas";
    protected $primaryKey = "idReservas";
    protected $fillable = [
        'id', 'idModulos',
        'idLaboratorios', 'idEstadoReserva',
        'fechaInicio', 'fechaFinal', 
        'horaInicio', 'horaFinal'
    ];
}
