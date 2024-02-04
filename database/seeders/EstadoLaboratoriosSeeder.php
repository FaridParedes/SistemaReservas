<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstadoLaboratoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                'estado' => 'Disponible',
                'created_at' => Carbon::now()
            ],
            [
                'estado' => 'No disponible',
                'created_at' => Carbon::now()
            ]
        );

        DB::table('estado_laboratorios')->insert($data);
    }
}
