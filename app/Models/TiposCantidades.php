<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposCantidades extends Model
{
    use HasFactory;

    protected $table = "tipos_cantidades";
    protected $primaryKey = "idTipos_cantidades";
    protected $fillable = ['tipo'];
}
