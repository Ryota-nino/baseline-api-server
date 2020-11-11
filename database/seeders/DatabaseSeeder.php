<?php

namespace Database\Seeders;

use App\Models\CompanyComment;
use App\Models\Company;
use App\Models\Draft;
use App\Models\CompanyInformation;
use App\Models\EmploymentStatus;
use App\Models\MyActivity;
use App\Models\Selection;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ララベル アドミン',
            'email' => 'laravel-a@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);


        User::factory(50)->create();
        MyActivity::factory(200)->create();
        Draft::factory(200)->create();

        $this->call(PrefectureTableSeeder::class);
        $this->call(InternshipSeeder::class);
        $this->call(OccupationalCategoriesSeeder::class);

        Company::factory(50)->create();
        Company::all()->each(function (Company $company) {
            for ($i = 0; $i < rand(0, 5); $i++) {
                try {
                    $company->prefectures()->attach(rand(1, 47));
                } catch (QueryException $qe) {
                }
            }
        });

        // 就職状況をランダムで生成
        for ($i = 0; $i < 200; $i++) {
            try {
                EmploymentStatus::factory()->create();
            } catch (QueryException $qe) {
            }
        }

        // 企業コメントをランダムで生成
        CompanyComment::factory(50)->create();

        // 投票をランダムで生成
        Selection::factory(50)->create();
    }
}
