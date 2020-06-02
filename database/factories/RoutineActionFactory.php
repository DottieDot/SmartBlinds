<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RoutineAction;
use Faker\Generator as Faker;

$factory->define(RoutineAction::class, function (Faker $faker) {
    return [
        'state' => $faker->randomFloat(1, 0, 1),
    ];
});
