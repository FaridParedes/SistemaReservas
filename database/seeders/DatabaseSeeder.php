<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EstadoHerramientas;
use App\Models\EstadoMaterialGastable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolSeeder::class,
            EstadoReservaSeeder::class,
            DiasSeeder::class,
            EstadoHerramientasSeeder::class,
            EstadoEquiposSeeder::class,
            EstadoLaboratoriosSeeder::class,
            SistemasOperativosSeeder::class,
            EstadoMaterialesGastablesSeeder::class,
            TiposCantidadesSeeder::class
        ]);
    }
}
