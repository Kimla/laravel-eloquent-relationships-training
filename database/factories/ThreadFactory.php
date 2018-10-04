<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'subreddit_id' => function() {
            return factory(App\Subreddit::class)->create()->id;
        },
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'title' => $faker->word,
        'description' => $faker->paragraph,
    ];
});
