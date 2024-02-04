<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SistemasOperativosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                'nombre' => 'windows 10',
                'created_at' => Carbon::now()
            ],
            [
                'nombre' => 'windows 8.4',
                'created_at' => Carbon::now()
            ]
        );

        DB::table('sistemas_operativos')->insert($data);
    }
}
