<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateGroupRequest extends Request {

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
		$group = $this->route('group');
		return [
			'name' => 'required|min:3|unique:groups,name,'.$group['id'],
			'description' => 'required|min:3',
			'role_id' => 'required|numeric|exists:roles,id'
		];
	}

}
