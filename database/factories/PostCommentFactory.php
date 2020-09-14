<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PostComment;
use Faker\Generator as Faker;

$factory->define(PostComment::class, function (Faker $faker) {

    return [
        'post_id' => $faker->word,
        'comment' => $faker->text,
        'parent_comment_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_by' => $faker->word,
        'updated_by' => $faker->word
    ];
});
