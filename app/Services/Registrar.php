<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use App\RegistrationLink;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data) {
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data) {
		$registration_link = RegistrationLink::valid()->where('_token', $data['_reg_token'])->first();

		$group_id = 2; // At this moment this is ID for users

		if ($registration_link) {
			$group_id = $registration_link->group_id;
			$registration_link->delete($data['_reg_token']);
		}

		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'group_id' => $group_id,
			'active' => true,
		]);
	}

}
