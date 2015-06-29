<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('menus', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_ka');
			$table->string('name_en');
			$table->string('name_ru');
			$table->integer('order');
			$table->integer('parent_id')->unsigned();
			$table->integer('status_id')->unsigned();
			$table->integer('location_id')->unsigned();
			$table->integer('slug_id')->unsigned();
			// $table->foreign('status_id')->references('id')->on('menu_statuses')->onDelete('cascade');
			// $table->foreign('location_id')->references('id')->on('menu_locations')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('menus');
	}

}
