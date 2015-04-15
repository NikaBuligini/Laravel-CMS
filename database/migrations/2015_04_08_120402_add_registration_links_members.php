<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistrationLinksMembers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::table('registration_links')->insert(
			['_token' => '2cttE3cuVvA1uixKDvadwMn4Cl0O62dIeP1RT1JQ', 
				'group_id' => 1, 
				'valid_until' => date('Y-m-d H:m:s', strtotime('+1 day')), 
				'created_at' => date('Y-m-d H:m:s'), 
				'updated_at' => date('Y-m-d H:m:s')]
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::table('registration_links')->truncate();
	}

}
