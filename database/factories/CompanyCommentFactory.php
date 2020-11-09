<?php

namespace Database\Factories;

use App\Models\CompanyInformation;
use App\Models\CompanyComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_information_id' => CompanyInformation::factory(),
            'comment_content' => $this->faker->text($this->faker->numberBetween(30, 200)),
        ];
    }
}
