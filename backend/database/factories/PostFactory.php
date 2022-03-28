<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker,$user) {
    $array = [
        'title' => "Street Food",
        'description' => "Delicious.Near Kannar.",
        'public_flag' => 1,
        'created_by' => 1,
        'updated_by' => 1,
    ];
    return $array;
});
