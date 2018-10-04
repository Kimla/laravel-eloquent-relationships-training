<?php

use Faker\Generator as Faker;

$factory->define(App\Subreddit::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
