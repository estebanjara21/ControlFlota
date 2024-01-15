<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_circuito'=> fake()->randomElement(['1'],['2']),
            'id_subcircuito'=> fake()->randomElement(['1'],['2']),
            'tipo'=> fake()->randomElement(['1'],['2']),
            'descripcion'=> fake()->text(maxNbChars: 200),
            'contactos'=> fake()->text(maxNbChars: 30),
            'apellidos'=> fake()->text(maxNbChars: 30),
            'nombres'=> fake()->text(maxNbChars: 30),

        ];
    }
}
