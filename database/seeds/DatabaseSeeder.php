<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BookSiteTypesTableSeeder::class);
         $this->call(BookSitesTableSeeder::class);
         $this->call(BooksTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(CustomersTableSeeder::class);
         $this->call(TransactionsTableSeeder::class);
    }
}
