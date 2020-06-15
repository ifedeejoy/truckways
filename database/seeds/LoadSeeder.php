<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class LoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker  $faker)
    {
        DB::table('loads')->insert([
            'reference' => mt_rand(),
            'user' => 1,
            'pickup' => $faker->address,
            'delivery' => $faker->address,
            'isPremium' => 0,
            'truck_type' => "50 Tonne Flat Bed",
            'created_at' => $faker->dateTime($min = 'now', $timezone = 'Africa/Lagos')->format('Y-m-d H:i:s')
        ]);
    }
}
