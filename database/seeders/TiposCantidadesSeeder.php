<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TiposCantidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = array(
            [
                "tipo" => "Metros",
                "created_at" => Carbon::now()
            ],
            [
                "tipo" => "Unidades",
                "created_at" => Carbon::now()
            ],
            [
                "tipo" => "Pulgadas",
                "created_at" => Carbon::now()
            ]
        );

        DB::table('tipos_cantidades')->insert($datos);
    }
}
