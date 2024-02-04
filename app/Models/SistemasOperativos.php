<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemasOperativos extends Model
{
    use HasFactory;

    protected $table = "sistemas_operativos";
    protected $primaryKey = "idSistemasOperativos";
    protected $fillable = [
        'nombre'
    ];
}
