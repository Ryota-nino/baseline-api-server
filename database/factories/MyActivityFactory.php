<?php

namespace Database\Factories;

use App\Models\CompanyInformation;
use App\Models\MyActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class MyActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MyActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_information_id' => CompanyInformation::factory(),
            'content' => $this->faker->text($this->faker->numberBetween(30, 200)),
            'posted_year' => $this->faker->numberBetween(1, 4),
        ];
    }
}
