<?php

use Faker\Generator as Faker;

$factory->define(App\Medication::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dose' => $faker->sentence,
    ];
});
