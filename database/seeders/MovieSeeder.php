<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('movies')->insert([
                'title' => $faker->text(25),
                'poster' => 'https://i1-vnexpress.vnecdn.net/2024/06/29/0aa0040adb5e7900204f-171962595-3091-8703-1719626024.jpg?w=680&h=408&q=100&dpr=1&fit=crop&s=JDyg3Ee4qQGoa3fMptig5w',
                'intro' => $faker->text(250),
                'release_date' => $faker->date(), 
                'genre_id' => rand(1, 5) 
            ]);
        }
    }
}

