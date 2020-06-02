<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\System;
use Faker\Generator as Faker;

$factory->define(System::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'state' => $faker->randomFloat(1, 0, 1),
    ];
});
