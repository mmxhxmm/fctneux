<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creates 2 empresas each with 1 ResponsableConvenio, 2 CentroTrabajo and 2 PersonaContacto
        \App\Models\Empresa::factory(8)->create()->each(function ($empresa) {
            \App\Models\ResponsableConvenio::factory(1)->create([
                'empresa_id' => $empresa->id,
            ]);

            \App\Models\CentroTrabajo::factory(2)->create([
                'empresa_id' => $empresa->id,
            ])->each(function ($centroTrabajo) {
                \App\Models\PersonaContacto::factory(2)->create([
                    'id_centrosTrabajo' => $centroTrabajo->id,
                ]);
            });

            // And with 2 practicas each with 1 tutor and 1 tutor empresa
            \App\Models\Practica::factory(2)->create([
                'tecnicoGestion' => 1,
                'empresa_id' => $empresa->id,
            ])->each(function ($practica) {
                \App\Models\Tutor::factory(1)->create([
                    'id_practica' => $practica->id,
                ]);
                \App\Models\TutorEmpresa::factory(1)->create([
                    'id_practica' => $practica->id,
                ]);
            });

            // With 2 Tareas
            \App\Models\Tarea::factory(2)->create([
                'empresa_id' => $empresa->id,
            ]);
        });

        $this->call([
            UserSeeder::class,
        ]);

        // Crear 10 usuarios aleatorios
        User::factory()->count(10)->create();
    }
}
