<?php

namespace Database\Factories;

use App\Models\CompanyInformation;
use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_information_id' => CompanyInformation::factory(),
            'title' => $this->faker->text($this->faker->numberBetween(7, 50)),
            'content' => $this->faker->text($this->faker->numberBetween(30, 200)),
        ];
    }
}
