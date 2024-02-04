<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasReserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "diasreserva";
    protected $fillable = ['idDia', 'idReserva'];
}
