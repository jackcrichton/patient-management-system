<?php

use Faker\Generator as Faker;

$factory->define(App\PatientAllergy::class, function (Faker $faker) {
    return [
        'patientId' => function () {
            return factory(App\Patient::class)->create()->id;
        },
        'allergyId' => function () {
            return factory(App\Allergy::class)->create()->id;
        },
        'reactionSeverity' => $faker->randomElement(array('Mild', 'Moderate', 'Severe')),
        'reaction' => $faker->sentence,
        'sourceOfInfo' => $faker->randomElement(array('Practise reported', 'Patient reported', 'Allergy history', 'Transition of care/referral')),
        'status' => $faker->randomElement(array('Active', 'Inactive', 'Resolved'))
    ];
});
