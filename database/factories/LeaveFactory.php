<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Leave;
use Faker\Generator as Faker;

$factory->define(Leave::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'from_date' => $faker->word,
        'to_date' => $faker->word,
        'reason' => $faker->text,
        'compoff' => $faker->word,
        'compoffreason' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_by' => $faker->word,
        'updated_by' => $faker->word,
        'deleted_by' => $faker->word
    ];
});
