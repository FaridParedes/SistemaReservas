<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoReservas extends Model
{
    use HasFactory;

    protected $table = "estado_reservas";
    protected $primaryKey = "idEstadoReserva";
    protected $fillable = ['estado'];
}
