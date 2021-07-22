<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
     * @return array
     */
    public function definition()
    {
        $genres = ['Fiction', 'Novel', 'Science Fiction', 'Narrative', 'Mystery'];
        return [
            'name'          => $this->faker->name(),
            'birth_date'    => $this->faker->dateTimeThisYear(),
            'genre'         => Arr::random($genres)
        ];
    }
}
