<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuracionReservas extends Model
{
    use HasFactory;

    protected $table = "duracion_reservas";
    protected $primaryKey = "idDurarionReservas";
    protected $fillable = ['idLaboratorios', 'idReserva', 'fecha', 'horaInicio', 'horaFinal'];
}
