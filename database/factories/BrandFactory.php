<?php

use Faker\Generator as Faker;

$factory->define(\Ignite\Brand::class, function (Faker $faker) {
    $countries = Ignite\Country::all();
    return [
        'name' => $faker->unique()->company,
        'country_id' => $countries[rand(0, count($countries) - 1)]->id,
    ];
});
