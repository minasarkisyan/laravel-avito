<?php

use Faker\Generator as Faker;

$factory->define(\App\Region::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
        'slug' => $faker->unique()->slug,
        'parent_id' => null
    ];
});
