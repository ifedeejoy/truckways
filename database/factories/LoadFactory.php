<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Loads;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Loads::class, function (Faker $faker) {
    return [
        'reference' =>$faker->randomDigit,
        'user' => 1,
        'pickup' => $faker->address,
        'delivery' => $faker->address,
        'truck_type' => "50 Tonne Flat Bed",
    ];
});
