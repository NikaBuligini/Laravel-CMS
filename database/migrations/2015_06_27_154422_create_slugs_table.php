<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlugsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('slugs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('slug_attribute_id')->unsigned();
			$table->foreign('slug_attribute_id')->references('id')->on('slug_attributes')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('slugs');
	}

}
