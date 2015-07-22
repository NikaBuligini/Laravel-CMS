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
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('content_types')->onDelete('cascade');
			$table->integer('slug_id')->unsigned();
			$table->string('url');
			$table->string('static_file_name');
			$table->string('image');
			$table->string('name_ka');
			$table->string('name_en');
			$table->string('name_ru');
			$table->string('description_ka');
			$table->string('description_en');
			$table->string('description_ru');
			$table->string('body_ka');
			$table->string('body_en');
			$table->string('body_ru');
			$table->string('gallery');
			$table->timestamp('publish_date');
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
