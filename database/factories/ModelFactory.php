<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use MyBlog\User;

$factory->define(MyBlog\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'nickname' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(MyBlog\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author_id' => 1,
    ];
});

$factory->define(MyBlog\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(MyBlog\Comment::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->safeEmail,
        'content' => $faker->paragraph,
        'confirmed' => false,
        'post_id' => $faker->numberBetween(1, 15),
    ];
});
