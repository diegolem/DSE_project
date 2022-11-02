<?php

use Faker\Generator as Faker;

$factory->define(\Ignite\CarModel::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName(),
        'brand_id' => rand(1, 10),
    ];
});
