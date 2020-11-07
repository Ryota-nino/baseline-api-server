<?php

namespace Database\Factories;

use App\Models\CompanyInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'company_id' => $this->faker->numberBetween(1, 50),
            'internship_id' => $this->faker->numberBetween(1, 4),
            'occupational_category' => $this->faker->numberBetween(1, 27),
        ];
    }
}
