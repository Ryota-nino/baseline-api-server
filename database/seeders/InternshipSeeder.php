<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('internships')->insert([
            ['internship_name' => 'サマーインターン'],
            ['internship_name' => 'ウィンターインターン'],
            ['internship_name' => 'スプリングインターン'],
            ['internship_name' => '本選考'],
        ]);
    }
}
