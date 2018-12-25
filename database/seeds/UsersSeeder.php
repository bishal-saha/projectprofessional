<?php

use App\Role;
use App\Support\Enum\UserStatus;
use App\User;
use App\UserProfile;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name', 'Admin')->first();

        $admin = factory(User::class)->create([
			'username' => 'admin',
			'password' => 'admin123',
			'email' => 'bishal.saha@gmail.com',
			'phone' => '8240574650',
			'is_admin' => 1,
			'role_id' => $admin->id,
			'status' => UserStatus::ACTIVE
		])->each( function ($user) {
			factory(UserProfile::class)->create([
				'user_id' => $user->id
			]);
		} );

		$users = factory(User::class, 50)->create()->each( function ($user) {
			factory(UserProfile::class)->create([
				'user_id' => $user->id
			]);
		} );
    }
}
