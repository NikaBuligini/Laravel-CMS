<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesMembers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::table('roles')->insert(
			['name' => 'Superadmin', 'level' => 1, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')]
		);
		DB::table('roles')->insert(
			['name' => 'Admin', 'level' => 2, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')]
		);
		DB::table('roles')->insert(
			['name' => 'User', 'level' => 3, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')]
		);
		DB::table('roles')->insert(
			['name' => 'Restricted', 'level' => 4, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')]
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::table('roles')->truncate();
	}

}
