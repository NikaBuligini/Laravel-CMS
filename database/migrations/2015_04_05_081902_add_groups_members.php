<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupsMembers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::table('groups')->insert(
			['name' => 'Creators', 'description' => 'main group', 'role_id' => 1, 
			'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')]
		);
		DB::table('groups')->insert(
			['name' => 'Users', 'description' => 'Just a mortal user', 'role_id' => 3, 
			'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')]
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::table('groups')->truncate();
	}

}
