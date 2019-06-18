<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'content' => $faker->realText(200, 2),
        'author' => $faker->name,
    ];
});
