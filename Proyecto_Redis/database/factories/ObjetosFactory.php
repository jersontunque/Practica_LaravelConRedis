<?php

namespace Database\Factories;

use App\Models\objetos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<objetos>
 */
class ObjetosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'cantidad' =>$this->faker->numberBetween(1,40),
            'tipo' => $this->faker->randomElement(['electronico', 'mettalico', 'Juguete'])
        ];
    }
}
