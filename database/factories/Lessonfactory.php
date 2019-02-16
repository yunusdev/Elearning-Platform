<?php

use Faker\Generator as Faker;

$factory->define(\App\Model\Lesson::class, function (Faker $faker) {

//    $rand = rand(1, 9) * 100;
    $vimeo_ids = ['155621416', '155621416', '140386576', '109527270',
                '98601226', '98520780', '42120028', '32334504',
                '31077756', '14190306', '17996952'];
    return [
        //
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(rand(3,7)),
        'episode_number' => $faker->unique()->numberBetween($min = 1, $max = 25) * 100,
        'video_id' => $faker->randomElement($vimeo_ids)
    ];


});


