<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PracticaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 year');
        
        return [
            'cicloFormativo' => $this->faker->randomElement([
                'daw',
                'asix',
                'dam',
                'marketing'
            ]),
            'cursoAcademico' => $this->faker->randomElement(['2022/2023', '2023/2024', '2024/2025']),
            'numPlazasAsignadas' => $this->faker->numberBetween(0, 10),
            'periodoFrom' => $startDate,
            'periodoTo' => $endDate,
            'horarioFrom' => $this->faker->randomElement(['9:00', '9:30', '10:00', '10:30']),
            'horarioTo' => $this->faker->randomElement(['14:00', '14:30', '15:00', '15:30']),
            'convenioMarco' => $this->faker->randomElement(['ceac', 'qbid']),
            'usoLogos' => $this->faker->randomElement(['si', 'no', 'autorizacion']),
            'observaciones' => $this->faker->optional(0.7)->text(200),
            'tecnicoGestion' => 1,
            'empresa_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
