<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('banners', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('url');
			$table->string('image');
			$table->integer('order');
			$table->integer('banner_type_id')->unsigned();
			$table->foreign('banner_type_id')->references('id')->on('banner_types');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('banners');
	}

}
