<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('contents', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('menu_id')->unsigned();
			$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
			$table->integer('status_id')->unsigned();
			$table->foreign('status_id')->references('id')->on('content_statuses')->onDelete('cascade');
			$table->string('url');
			$table->string('name_ka');
			$table->string('name_en');
			$table->string('name_ru');
			$table->string('short_ka');
			$table->string('short_en');
			$table->string('short_ru');
			$table->string('desc_ka');
			$table->string('desc_en');
			$table->string('desc_ru');
			$table->string('gallery');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('contents');
	}

}
