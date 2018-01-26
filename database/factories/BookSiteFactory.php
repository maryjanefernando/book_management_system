<?php

use Faker\Generator as Faker;

$factory->define(App\BookSite::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'site_type' => rand(1, 3),
        'site_info' => $faker->streetName,
    ];
});
