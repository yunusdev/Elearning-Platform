<?php

use Faker\Generator as Faker;

$factory->define(\App\Model\Series::class, function (Faker $faker) {

    $title = $faker->sentence(5);
    return [
        //

        'title' => $title,
        'slug' => str_slug($title),
        'image_url' => $faker->imageUrl($width=1920, $height=1283),
        'description' => $faker->paragraph(rand(3,7))

    ];
});
