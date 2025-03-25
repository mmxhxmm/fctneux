<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(3),
            'asignado' => $this->faker->name,
            'estado' => $this->faker->randomElement(['to_do', 'in_progress', 'revision', 'done']),
            'descripcion' => $this->faker->optional()->paragraph,
            'comentarios' => $this->faker->optional()->text,
            'empresa_cif' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
