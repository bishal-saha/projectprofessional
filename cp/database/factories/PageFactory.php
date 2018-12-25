<?php

use Faker\Generator as Faker;

$factory->define(\App\Page::class, function (Faker $faker) {
    return [
		'author_id' => function() use ($faker) {
    		return $faker->randomElement(\App\User::pluck('id')->toArray());
		},
		'name' => $faker->sentence($nb = 3, $variableNbWords = true),
		'excerpt' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
		'content' => $faker->text(),
		'image' => null,
		'meta_title' => $faker->sentence($nb = 8, $variableNbWords = true),
		'meta_keywords' => implode(', ', $faker->words($nb = 6, $asText = false)),
		'meta_description' => $faker->sentence($nb = 8, $variableNbWords = true),
		'is_active' => true
    ];
});
