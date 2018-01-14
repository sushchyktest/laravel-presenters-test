<?php

use Faker\Generator as Faker;

$factory->define(Sushchyk\Presenters\Tests\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'birth_date' => $faker->date(),
    ];
});
