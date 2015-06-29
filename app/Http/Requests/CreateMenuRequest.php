<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMenuRequest extends Request {

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
			'name_ka' => 'required|min:2',
			'name_en' => 'required|min:2',
			'name_ru' => 'required|min:2',
			'slug' => 'required|min:2|unique:slugs,name',
			'parent_id' => 'required|numeric|min:0',
			'status_id' => 'required|numeric|exists:menu_statuses,id',
			'location_id' => 'numeric|exists:menu_locations,id',
		];
	}

}
