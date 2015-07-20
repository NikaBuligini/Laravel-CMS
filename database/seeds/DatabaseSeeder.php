<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Role;
use App\Group;
use App\RegistrationLink;
use App\MenuStatus;
use App\MenuLocation;
use App\SlugAttribute;
use App\ContentStatus;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		$this->call('RoleSeeder');
		$this->call('GroupSeeder');
		$this->call('RegistrationLinkSeeder');
		$this->call('MenuStatuseSeeder');
		$this->call('MenuLocationSeeder');
		$this->call('SlugAttributeSeeder');
		$this->call('ContentStatusesSeeder');
	}

}




class RoleSeeder extends Seeder {

	public function run() {
		DB::table('roles')->delete();

		Role::create(['name' => 'Superadmin', 'level' => 1]);
		Role::create(['name' => 'Admin', 'level' => 2]);
		Role::create(['name' => 'User', 'level' => 3]);
		Role::create(['name' => 'Restricted', 'level' => 4]);
	}

}

class GroupSeeder extends Seeder {

	public function run() {
		DB::table('groups')->delete();

		Group::create(['name' => 'Creators', 'description' => 'main group', 'role_id' => 1]);
		Group::create(['name' => 'Users', 'description' => 'Just a mortal user', 'role_id' => 3]);
	}

}

class RegistrationLinkSeeder extends Seeder {

	public function run() {
		DB::table('registration_links')->delete();

		RegistrationLink::create(['_token' => '2cttE3cuVvA1uixKDvadwMn4Cl0O62dIeP1RT1JQ', 'group_id' => 1, 
			'valid_until' => date('Y-m-d H:m:s', strtotime('+1 day'))]);
	}

}

class MenuStatuseSeeder extends Seeder {

	public function run() {
		DB::table('menu_statuses')->delete();

		MenuStatus::create(['name_ka' => 'Active', 'name_en' => 'Active', 'name_ru' => 'Active']);
		MenuStatus::create(['name_ka' => 'Canceled', 'name_en' => 'Canceled', 'name_ru' => 'Canceled']);
	}

}

class MenuLocationSeeder extends Seeder {

	public function run() {
		DB::table('menu_locations')->delete();

		MenuLocation::create(['name_ka' => 'Header', 'name_en' => 'Header', 'name_ru' => 'Header']);
		MenuLocation::create(['name_ka' => 'Footer', 'name_en' => 'Footer', 'name_ru' => 'Footer']);
	}

}

class SlugAttributeSeeder extends Seeder {

	public function run() {
		DB::table('slug_attributes')->delete();

		SlugAttribute::create(['name' => 'Menu']);
		SlugAttribute::create(['name' => 'Content']);
	}

}

class ContentStatusesSeeder extends Seeder {

	public function run() {
		DB::table('content_statuses')->delete();

		ContentStatus::create(['name' => 'Static']);
		ContentStatus::create(['name' => 'Dynamic']);
		ContentStatus::create(['name' => 'URL']);
	}

}
