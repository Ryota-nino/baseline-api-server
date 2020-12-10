<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyComment;
use App\Models\CompanyInformation;
use App\Models\Draft;
use App\Models\EmploymentStatus;
use App\Models\Entry;
use App\Models\MyActivity;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
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
        User::factory()->make([
            'student_number' => 1000000,
            'first_name' => 'アドミン',
            'last_name' => 'ララベル',
            'sex' => 2,
            'annual' => 4,
            'year_of_graduation' => Carbon::parse('2021/04/01'),
            'icon_image_path' => 'storage/example_user_icon.jpg',
            'desired_occupations' => 1,
            'privilege' => 2,
            'email' => 'laravel-a@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->save();

        User::factory()->make([
            'student_number' => 1000000,
            'first_name' => 'ティーチャー',
            'last_name' => 'ララベル',
            'sex' => 2,
            'annual' => 4,
            'year_of_graduation' => Carbon::parse('2021/04/01'),
            'icon_image_path' => 'storage/example_user_icon.jpg',
            'desired_occupations' => 1,
            'privilege' => 0,
            'email' => 'laravel-t@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->save();

        User::factory()->make([
            'student_number' => 1000000,
            'first_name' => 'ユーザー',
            'last_name' => 'ララベル',
            'sex' => 2,
            'annual' => 4,
            'year_of_graduation' => Carbon::parse('2021/04/01'),
            'icon_image_path' => 'storage/example_user_icon.jpg',
            'desired_occupations' => 1,
            'privilege' => 0,
            'email' => 'laravel-u@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->save();


        User::factory(47)->create();
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

        // アクティビティをランダム背生成
        MyActivity::factory(200)->create();

        // 企業コメントをランダムで生成
        CompanyComment::factory(50)->create();

        // 投票をランダムで生成
        //Selection::factory(50)->create();
        // 面接を50件生成
        CompanyInformation::factory(50)
            ->create()
            ->each(function (CompanyInformation $companyInformation) {
                $faker = FakerFactory::create();

                // 面接のステップ1~5ランダム生成
                for ($i = 0; $i < rand(1, 5); $i++) {
                    $id = DB::table('interviews')->insertGetId([
                        'company_information_id' => $companyInformation->id,
                        'step' => ($i + 1),
                        'results' => rand(0, 1),
                        'interview_date' => $faker->date()
                    ]);

                    // 面接内容を数件追加
                    for ($j = 0; $j < rand(1, 5); $j++) {
                        DB::table('interview_contents')->insert([
                            'interview_id' => $id,
                            'content' => $faker->sentence($faker->numberBetween(30, 200))
                        ]);
                    }
                }
            });
        CompanyInformation::factory(50)
            ->create()
            ->each(function (CompanyInformation $companyInformation) {
                $faker = FakerFactory::create();
                $id = DB::table('selections')->insertGetId([
                    'company_information_id' => $companyInformation->id,
                    'title' => $faker->text($faker->numberBetween(7, 50)),
                    'content' => $faker->text($faker->numberBetween(30, 200)),
                    'interview_date' => $faker->date()
                ]);
            });
        Entry::factory(50)->create();
    }
}
