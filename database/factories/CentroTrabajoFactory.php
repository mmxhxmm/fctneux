<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CentroTrabajoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'direccion' => $this->faker->address,
            'codigoPostal' => $this->faker->randomNumber(5, true),
            'ubicacion' => $this->faker->city,
            'municipio' => $this->faker->city,
            'empresa_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
