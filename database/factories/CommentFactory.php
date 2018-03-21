<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'article_id' => function () {
            return factory(\App\Article::class)->create()->id;
        },
        'name' => $faker->name,
        'content' => $faker->paragraphs(2, true),
    ];
});
