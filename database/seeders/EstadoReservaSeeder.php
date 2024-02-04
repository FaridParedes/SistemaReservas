<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstadoReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
                'estado' => 'Aprobado'
            ],
            [
                'estado' => 'Rechazado'
            ],
            [
                'estado' => 'Procesando'        
            ],
            [
                'estado' => 'Cancelado'
            ],
            [
                'estado' => 'Entregado'
            ]
        );

        DB::table('estado_reservas')->insert($data);
    }
}
