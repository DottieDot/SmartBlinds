<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Routine;
use Faker\Generator as Faker;

$factory->define(Routine::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'trigger_at' => $faker->time(),
        'days' => $faker->numberBetween(0, 0b01111111),
    ];
});
