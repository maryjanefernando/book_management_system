<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'employee_id' => rand(1, 5),
        'customer_id' => rand(1, 5),
        'book_id' => rand(1, 20),
    ];
});
