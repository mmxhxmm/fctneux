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
            'codigoPostal' => $this->faker->randomNumber(5, true),
            'comunidad' => $this->faker->randomElement(['catalunya', 'aragon', 'canarias']),
            'provincia' => $this->faker->randomElement(['barcelona', 'zaragoza', 'sevilla']),
            'municipio' => $this->faker->city,
            'direccion' => $this->faker->address,
            'empresa_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
