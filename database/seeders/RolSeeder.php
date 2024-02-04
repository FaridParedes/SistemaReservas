<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=array([
                'estado' => 'administrador'
            ],
            [
                'estado' => 'docente'
            ]
        );
        
        DB::table('roles')->insert($data);
    }
}
