<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use Carbon\Carbon;

class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'group_id' => 'required|numeric|exists:groups,id',
			'valid_until' => 'required|after:'.date('Y-m-d', strtotime('-1 day'))
		];
	}

}
