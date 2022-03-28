<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'edad' => $this->faker->numberBetween(1,100),
            'CI' => $this->faker->unique()->numerify('##########'),
            'sexo' => $this->faker->randomElement(['Femenini', 'Masculino']),
            'tipo_sangre' => $this->faker->randomElement(['A+', 'O-', 'A-']),
            'telefono' => $this->faker->phoneNumber(),
            'correo' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->word(15),
            'created_at' => $this->faker->date('Y-m-d'),
            'updated_at' => $this->faker->date('now')


        ];
    }
}
