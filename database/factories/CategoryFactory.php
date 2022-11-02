<?php

use Faker\Generator as Faker;

$factory->define(\Ignite\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->hexColor,
        'description' => $faker->text(40)
    ];
});
