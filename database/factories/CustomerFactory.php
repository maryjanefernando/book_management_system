<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'bank_account_no' => implode($faker->randomElements($numbers, 12, true)),
    ];
});
