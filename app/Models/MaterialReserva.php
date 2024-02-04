<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "materialreserva";
    protected $fillable = ['id','idMaterial', 'idReserva','cantidad'];
}
