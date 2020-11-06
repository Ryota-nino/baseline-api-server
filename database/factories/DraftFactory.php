<?php

namespace Database\Factories;

use App\Models\Draft;
use Illuminate\Database\Eloquent\Factories\Factory;

class DraftFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Draft::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text($this->faker->numberBetween(30, 200)),
            'posted_by' => $this->faker->numberBetween(1, 50),
        ];
    }
}
