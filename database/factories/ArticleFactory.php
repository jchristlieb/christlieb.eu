<?php

use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    $title = $faker->words(rand(5,8), true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->paragraphs(rand(10,20), true)
    ];
});
