<?php

use App\Role;
use App\Support\Enum\UserStatus;
use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
	$user = Role::where('name', 'User')->first();
    return [
    	'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'username' => $faker->userName,
		'password' => 'password',
        'email' => $faker->unique()->safeEmail,
		'phone' => $faker->unique()->phoneNumber,
		'is_admin' => '0',
		'role_id' => $user->id,
		'status' => UserStatus::ACTIVE,
        'email_verified_at' => now(),
        'remember_token' => str_random(10),
    ];
});
