<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('seo_title')->nullable();
			$table->string('seo_keywords')->nullable();
			$table->text('seo_description')->nullable();

			$table->integer('menu_id')->unsigned()->nullable();
			$table->foreign('menu_id')->references('id')->on('menus');

			$table->integer('language_id')->unsigned();
			$table->foreign('language_id')->references('id')->on('languages');

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
        Schema::dropIfExists('seos');
    }
}
