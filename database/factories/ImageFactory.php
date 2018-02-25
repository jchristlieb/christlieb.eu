<?php

use Faker\Generator as Faker;

$factory->define(\App\Image::class, function (Faker $faker) {
    return [
        'alt' => $faker->sentence,
        'title' => $faker->paragraphs(1, true),
        'path' => function () use ($faker) {
            $path = Storage::disk('public')->put('images', \Illuminate\Http\UploadedFile::fake()->image('test.png'));

            return $path;
        },
    ];
});

$factory->state(\App\Image::class, 'seedImages', function (Faker $faker) {
    return [
        'path' => function () use ($faker) {
            $path = $faker->image('storage/app/public/images', 400, 300);

            return str_replace('storage/app/public/', '', $path);
        },
    ];
});
