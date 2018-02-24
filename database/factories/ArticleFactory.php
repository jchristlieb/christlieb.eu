<?php

use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    $title = $faker->words(rand(5, 8), true);

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->paragraphs(rand(10, 20), true),
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
    ];
});

$factory->state(\App\Article::class, 'promoted_first', function (Faker $faker) {
    return [
       'promoted' => 1,
   ];
});

$factory->state(\App\Article::class, 'promoted_second', function (Faker $faker) {
    return [
        'promoted' => 2,
    ];
});

$factory->state(\App\Article::class, 'promoted_third', function (Faker $faker) {
    return [
        'promoted' => 3,
    ];
});
