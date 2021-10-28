<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flight;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {

    config()->set('database.connections.mysql.strict', false);
    DB::reconnect();

    return [
        'from' => $faker->city,
        'to' => $faker->city,
        'departure_date' => $faker->dateTimeThisMonth($max = 'now'),
        'time' => $faker->time($format = 'H:i'),
        'arrival_date' => $faker->dateTimeInInterval($startDate = '0 years', $interval = '+ 5 days'),
        'price' => $faker->numberBetween(200,500),
    ];

    config()->set('database.connections.mysql.strict', true);
    DB::reconnect();
});
