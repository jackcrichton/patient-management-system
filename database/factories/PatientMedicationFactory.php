<?php

use Faker\Generator as Faker;

$factory->define(App\PatientMedication::class, function (Faker $faker) {
    return [
        'patientId' => function () {
            return factory(App\Patient::class)->create()->id;
        },
        'medicationId' => function () {
            return factory(App\Medication::class)->create()->id;
        },
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'quantity' => $faker->randomNumber,
        'notes' => $faker->sentence,
    ];
});
