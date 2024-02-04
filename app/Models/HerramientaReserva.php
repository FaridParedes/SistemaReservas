<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HerramientaReserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "herramientareserva";
    protected $fillable = ['id','idHerramienta', 'idReserva','cantidad'];
}
