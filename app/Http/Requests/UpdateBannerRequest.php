<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateBannerRequest extends Request {

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
			'name' => 'required|min:2',
			'url' => 'required|url',
			'image' => 'required|url',
			'banner_type_id' => 'required|numeric|exists:banner_types,id'
		];
	}

}
