<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {

    do {
        $from = rand(1,20);
        $to=rand(1,20);
    }while($from === $to);

    return [
        //
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence,

    ];
});
