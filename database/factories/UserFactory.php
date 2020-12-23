<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $carbon = Carbon::parse('2020/04/01');
        $annual = $this->faker->numberBetween(2, 4);

        return [
            'student_number' => '2190' . $this->faker->numberBetween(100, 999),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'sex' => $this->faker->numberBetween(0, 2),
            'annual' => $this->faker->numberBetween(0, $annual),
            'year_of_graduation' => 20 + $this->faker->numberBetween($annual, 4),
//            'activity_stats' => $this->faker->numberBetween(0, 4),
            'desired_occupations' => $this->faker->numberBetween(1, 25),
            'privilege' => 0,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
