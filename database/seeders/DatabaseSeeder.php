<?php

namespace Database\Seeders;


use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();
        MyActivity::factory(200)->create();

        $this->call(PrefectureTableSeeder::class);

        Company::factory(50)->create();
        Company::all()->each(function (Company $company) {
           $company->prefectures()->attach(rand(1, 47));
        });


    }
}
