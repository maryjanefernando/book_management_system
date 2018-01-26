<?php

use Illuminate\Database\Seeder;

class BookSiteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_site_types')->insert([
            'type' => 'book_store',
        ]);
        DB::table('book_site_types')->insert([
            'type' => 'library',
        ]);
        DB::table('book_site_types')->insert([
            'type' => 'kiosk',
        ]);
    }
}
