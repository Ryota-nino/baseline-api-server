<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'frigana' => $this->faker->companySuffix . $this->faker->company,
            'company_name' => $this->faker->companySuffix . $this->faker->company,
            'number_of_employees' => $this->faker->numberBetween(0, 100000),
            'business_description' => $this->faker->sentence,
            'logo_path' => 'public/wkpfjwjdnljiapuw94.png',
            'company_url' => $this->faker->url,
        ];
    }
}
