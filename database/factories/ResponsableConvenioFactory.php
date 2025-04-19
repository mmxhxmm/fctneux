<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ResponsableConvenioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->regexify('[0-9]{8}[A-Z]{1}'),
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'telefono' => $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'empresa_id' => null, // This will be overridden in the seeder
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
