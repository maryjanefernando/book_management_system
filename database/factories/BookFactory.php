<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'author' => $faker->name,
        'site_id' => rand(1, 5),
    ];
});
