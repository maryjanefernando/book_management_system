<?php

use Illuminate\Database\Seeder;

class BookSitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BookSite::class, 10)->create();
    }
}
