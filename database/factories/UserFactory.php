<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'id' => $faker->numberBetween($min = 10000, $max = 99999),
      	'title' => $faker->randomElement($array = array('Dr', 'Mr', 'Mrs', 'Miss', 'Ms')),
        'forename' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'dateOfBirth' => $faker->dateTime($max = 'now', $timezone = null),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'active' => $faker->boolean,
        'role' => $faker->randomElement($array = array('superadmin', 'admin', 'doctor', 'nurse', 'receptionist')),
        'remember_token' => str_random(10),
    ];
});
