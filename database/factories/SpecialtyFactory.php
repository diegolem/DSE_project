<?php

use Faker\Generator as Faker;

$factory->define(\Ignite\Especialty::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->jobTitle,
        'description' => $faker->text(30),
    ];
});
