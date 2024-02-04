<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioReserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "comentariosreserva";
    protected $fillable = ['id','comentario', 'idReserva'];
}
