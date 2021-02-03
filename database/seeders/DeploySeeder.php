<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DeploySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->make([
            'student_number' => 1000000,
            'first_name' => 'アドミン',
            'last_name' => 'ララベル',
            'sex' => 2,
            'annual' => 4,
            'year_of_graduation' => 21,
            'icon_image_path' => '',
            'desired_occupations' => 1,
            'privilege' => 2,
            'email' => 'laravel-a@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->save();

        $this->call(PrefectureTableSeeder::class);
        $this->call(InternshipSeeder::class);
        $this->call(OccupationalCategoriesSeeder::class);
    }
}
