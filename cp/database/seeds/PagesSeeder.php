<?php

use App\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(Page::class, 50)->create();

		factory(Page::class)->create([ 'name' => 'Home' ]);
		factory(Page::class)->create([ 'name' => 'About Us' ]);
		factory(Page::class)->create([ 'name' => 'Contact Us' ]);
		factory(Page::class)->create([ 'name' => 'Terms of Services' ]);
		factory(Page::class)->create([ 'name' => 'Privacy Policy' ]);
		factory(Page::class)->create([ 'name' => 'Cookies Policy' ]);
    }
}
