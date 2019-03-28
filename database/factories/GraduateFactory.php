<?php

use Faker\Generator as Faker;

$factory->define(App\Graduate::class, function (Faker $faker) {
    return [
        'shared' => rand(1, 0),
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'matura_year' => $faker->year(),
        'description' => $faker->text(),
    ];
});
