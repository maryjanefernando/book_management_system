<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFieldsZerofill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `books` MODIFY COLUMN `id` INT(10) ZEROFILL NOT NULL AUTO_INCREMENT");
        DB::statement("ALTER TABLE `transactions` MODIFY COLUMN `id` INT(8) ZEROFILL NOT NULL AUTO_INCREMENT");
        DB::statement("ALTER TABLE `transactions` MODIFY COLUMN `book_id` INT(10) ZEROFILL NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `books` MODIFY COLUMN `id` INT(10) NOT NULL AUTO_INCREMENT");
        DB::statement("ALTER TABLE `transactions` MODIFY COLUMN `id` INT(8) NOT NULL AUTO_INCREMENT");
        DB::statement("ALTER TABLE `transactions` MODIFY COLUMN `book_id` INT(10) NOT NULL");
    }
}
