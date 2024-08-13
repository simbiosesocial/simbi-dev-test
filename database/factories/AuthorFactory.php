<?php

namespace Database\Factories;

use App\Infra\Adapters\Persistence\Eloquent\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infra\Adapters\Persistence\Eloquent\Models\Author>
 */
class AuthorFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => $this->faker->uuid(),
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName()
        ];
    }
}
