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
            'colaboracion' => $this->faker->randomElement(['prospeccion', 'colaboracion', 'inactiva']),
            'gestiones' => $this->faker->randomElement([
                'primer_contacto', 'pendente_respuesta', 'volver_contactar', 'no_acogen_alumnado', 
                'pendiente_firma_convenio', 'plazas_conseguidas', 'solicitud_plazas'
            ]),
            'modalidad' => $this->faker->randomElement(['presencial', 'remoto', 'semipresencial']),
            'ofertaLaboral' => $this->faker->randomElement(['si', 'no']),
            'entidad' => $this->faker->company,
            'comunidad' => $this->faker->randomElement(['Catalunya', 'Aragon', 'Canarias']),
            'provincia' => $this->faker->randomElement(['Barcelona', 'Zaragoza', 'Sevilla']),
            'municipio' => $this->faker->city,
            'direccion' => $this->faker->address,
            'codigoPostal' => $this->faker->randomNumber(5, true),
            'familiaPersonal' => $this->faker->randomElement(['sanidad', 'informatica', 'hosteleria', 'marketing']),
            'observaciones' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
