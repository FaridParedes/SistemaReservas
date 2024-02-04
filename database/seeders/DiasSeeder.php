<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array([
            'dia' => 'lunes'
        ],
        [
            'dia' => 'martes'
        ],
        [
            'dia' => 'miércoles'        
        ],
        [
            'dia' => 'jueves'
        ],
        [
            'dia' => 'viernes'
        ],
        [
            'dia' => 'sábado'        
        ],
        [
            'dia' => 'domingo'        
        ],
    );
    
    DB::table('dias')->insert($data) ;

    }
}
