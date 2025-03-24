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
                'Desarrollo de Aplicaciones Web',
                'Administración de Sistemas Informáticos',
                'Desarrollo de Aplicaciones Multiplataforma',
                'Marketing Digital',
                'Diseño Gráfico'
            ]),
            'cursoAcademico' => $this->faker->randomElement(['2022/2023', '2023/2024', '2024/2025']),
            'numPlazasAsignadas' => $this->faker->numberBetween(1, 10),
            'periodoFrom' => $startDate,
            'periodoTo' => $endDate,
            'horarioFrom' => $this->faker->time('H:i', '08:00'),
            'horarioTo' => $this->faker->time('H:i', '15:00'),
            'convenioMarco' => $this->faker->randomElement(['Sí', 'No', 'En proceso']),
            'usoLogos' => $this->faker->randomElement(['Permitido', 'No permitido', 'Solo en informes']),
            'tecnicoGestion' => $this->faker->name(),
            'observaciones' => $this->faker->optional(0.7)->text(200),
            'empresa_cif' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
