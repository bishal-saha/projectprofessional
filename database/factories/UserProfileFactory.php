<?php

use Faker\Generator as Faker;

$factory->define(App\UserProfile::class, function (Faker $faker) {
    return [
        'birthday' => $faker->date('Y-m-d', $max = '-18 years'),
		'avatar' => $faker->imageUrl($width = 150, $height = 150),
		'address' => $faker->streetAddress,
		'country_id' => 356
    ];
});
