<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateContentRequest extends Request {

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
			
			'menu_id' => 'required|numeric|exists:menus,id',
			'type_id' => 'required|numeric|exists:content_types,id',

			'slug' => 'required_if:type_id,1,2|min:2|unique:slugs,name',

			'static_file_name' => 'required_if:type_id,1|min:2',

			'publish_date' => 'required_if:type_id,2|date',
			'description_ka' => '',
			'description_en' => '',
			'description_ru' => '',
			'body_ka' => '',
			'body_en' => '',
			'body_ru' => '',

			'url' => 'required_if:type_id,3|url',
		];
	}

}
