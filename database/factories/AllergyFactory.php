<?php

use Faker\Generator as Faker;

$factory->define(App\Allergy::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement($array = array('Drug', 'Food', 'Environmental', 'Inhalant', 'Insect', 'Plant', 'Other')),
        'name' => $faker->name,
        'agent' => $faker->randomElement($array = array('Propensity    to    adverse    reaction (disorder)',   'Propensity   to   adverse   reaction   to   drug (disorder)',   'Propensity   to   adverse   reaction   to   food (disorder)', 'Allergy to substance (disorder)', 'Drug allergy (disorder)', 'Food allergy (disorder)', 'Drug intolerance (disorder)', 'Food intolerance (disorder)')),
    ];
});
