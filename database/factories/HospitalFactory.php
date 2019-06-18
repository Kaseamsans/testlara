<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Hospital;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    return [
        'name'=> $faker->company ,
        'address'=> $faker->address,
        'numberOfBeds' => $faker->numberBetween(10,10000),
        'numberOfDoctors' => $faker->numberBetween(10,1000)
    ];
});
