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
            ['name' => 'サマーインターン'],
            ['name' => 'ウィンターインターン'],
            ['name' => 'スプリングインターン'],
            ['name' => '本選考'],
        ]);
    }
}
