<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creates 2 empresas with 1:1 ResponsableConvenio
        \App\Models\Empresa::factory(2)->create()->each(function ($empresa) {
            \App\Models\ResponsableConvenio::factory(1)->create([
                'empresa_cif' => $empresa->cif,
            ]);
        });

        // Crear 10 usuarios aleatorios
        User::factory()->count(10)->create();
        
        $this->call([
            UserSeeder::class,
        ]);
    }
}
