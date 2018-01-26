<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('site_type')->unsigned();
            $table->foreign('site_type')->references('id')->on('book_site_types');
            $table->string('site_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_sites');
    }
}
