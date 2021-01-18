<?php

namespace Database\Factories;

use App\Models\EmploymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploymentStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmploymentStatus::class;

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
            'decision_offer' => $this->faker->numberBetween(0, 1),
            'occupational_category_id' => $this->faker->numberBetween(1, 25),
        ];
    }
}
