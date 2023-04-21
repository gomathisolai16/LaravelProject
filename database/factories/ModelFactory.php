<?php

use Illuminate\Support\Str;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Theme::class, function (\Faker\Generator $faker) {

    return [
        'abbreviation' => $faker->slug(2),
        'name' => $faker->title,
        'active' => true,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\News::class, function (\Faker\Generator $faker) {

    $keyWords = [];
    $length = rand(2, 7);

    for ($i = 0; $i < $length; $i++) {
        $keyWords[] = $faker->text(20);
    }

    return [
        'title' => $faker->title,
        'percentage' => rand(47.56, 87.54),
        'description' => $faker->text(),
        'meta_keywords' => json_encode($keyWords),
        'top' => rand(0, 1),
        'active' => 1
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Module::class, function (\Faker\Generator $faker) {

    static $counter = 0;

    return [
        'user_id' => rand(1, 50),
        'abbreviation' => $faker->slug(2),
        'name' => $faker->title,
        'sort_order' => $counter++,
        'active' => rand(0, 1),
        'public' => rand(0, 1),
        'preset' => rand(0, 1),
        'watch_list'=> rand(0, 1),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Dashboard::class, function (\Faker\Generator $faker) {

    return [
        'user_id' => rand(1, 50),
        'abbreviation' => $faker->slug(2),
        'name' => $faker->title,
        'active' => rand(0, 1),
        'public' => rand(0, 1),
        'preset' => rand(0, 1),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Ticker::class, function (\Faker\Generator $faker) {
    return [
        'abbreviation' => $faker->text(20)
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Image::class, function (\Faker\Generator $faker) {

    static $counter = 0;
    $counter++;

    return [
        'path' => $faker->imageUrl(),
        'size' => 'original',
        'title' => $faker->title
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Category::class, function (\Faker\Generator $faker) {

    static $counter = 0;
    $counter++;
    $subscriptionArray = [];
    $subscriptionArray[0] = \App\Models\Category::SUBSCRIPTION_BASIC;
    $subscriptionArray[1] = \App\Models\Category::SUBSCRIPTION_TRIAL;
    return [
        'category_id' => $counter > 3 ? ($counter > 15 ? rand(3, 15) : rand(1, 3)) : null,
        'abbreviation' => $faker->slug(2),
        'title' => $faker->title,
        'description' => $faker->text(),
        'subscription' => $subscriptionArray[rand(0,1)],
        'active' => 1
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Keyword::class, function (\Faker\Generator $faker) {

    return [
        'keyword' => $faker->text(7)
    ];
});

