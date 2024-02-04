<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaLaboratorio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "entregaslaboratorios";
    protected $primaryKey = "id";
    protected $fillable = [
        'idReserva', 'comentario'
    ];
}
