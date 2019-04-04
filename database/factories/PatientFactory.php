<?php

use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'forename' => $faker->firstName,
        'surname' => $faker->lastName,
        'dateOfBirth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'sex' => $faker->randomElement($array = array('male', 'female')),
        'firstLineAddress' => $faker->streetAddress,
        'town' => $faker->city,
        'country' => $faker->country,
        'postcode' => $faker->postcode,
        'mobileNo' => $faker->randomDigit(11),
        'email' => $faker->unique()->safeEmail,
        'userAssignedTo' => $faker->randomElement($array = array(11113)),
    ];
});
