<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50), // Supone que tienes usuarios con IDs del 1 al 100
            'titulo' => $this->faker->sentence($nbWords = rand(3, 8)),
            'tema' => $this->faker->word,
            'texto' => $this->faker->paragraphs($nb = 3, $asText = true),
            'imagen' => $this->faker->imageUrl($width = 640, $height = 480),
            'visitas' => $this->faker->numberBetween(0, 10000),
            'published_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'deleted_at' => null, // Puedes modificar esto si necesitas simular artículos eliminados
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
