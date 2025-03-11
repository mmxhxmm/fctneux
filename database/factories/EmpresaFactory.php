<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cif' => $this->faker->unique()->regexify('[A-Z]{1}[0-9]{8}'),
            'nombre' => $this->faker->company,
            'colaboracion' => $this->faker->randomElement(['Prospección', 'Colaboración']),
            'gestiones' => $this->faker->randomElement([
                'P - Primer contacto', 'P - Pendente respuesta', 'P - Volver a contactar', 'P - No acogen alumnado', 
                'E - Pendiente firma Convenio', 'E - Plazas conseguidas', 'E - Solicitud plazas'
            ]),
            'modalidad' => $this->faker->randomElement(['Presencial', 'Remoto', 'Semipresencial']),
            'oferta_laboral' => $this->faker->randomElement(['Si', 'No']),
            'entidad' => $this->faker->company,
            'ubicacion' => $this->faker->randomElement(['Cataluña', 'Fuera de Cataluña', 'Fuera de España']),
            'municipio' => $this->faker->city,
            'direccion' => $this->faker->address,
            'codigoPostal' => $this->faker->randomNumber(5, true),
            'familiaPersonal' => $this->faker->randomElement(['Sanidad', 'Informática', 'Hostelería', 'Marketing']),
            'observaciones' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
