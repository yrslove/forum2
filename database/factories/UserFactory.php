<?php



/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'confirmed' => true,
        'confirmation_token' => str_random(30)
    ];
});

$factory->state(\App\User::class,'unconfirmed',['confirmed' => false]);


$factory->define(App\Thread::class, function($faker){
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph,
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'channel_id' => function(){
            return factory('App\Channel')->create()->id;
        }
    ];
});

$factory->define(App\Reply::class,function($faker){
    return[
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },

        'thread_id' => function(){
            return factory('App\Thread')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Channel::class, function($faker){
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => $name,
    ];
});

