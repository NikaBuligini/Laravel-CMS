<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name_ka', 'name_en', 'name_ru'];

	public function contents() {
		return $this->hasMany('App\Content');
	}

	public function linkedName() {
		return '<a href="'.action('Admin\CategoryController@show', ['category' => $this->id]).'">'.$this->name_en.'</a>';
	}

	public static function chooseCategories() {
		$categories = ['0' => '---'];
		foreach (Category::all()->lists('name', 'id') as $key => $value) {
			array_push($categories, $value);
		}
		return $categories;
	}

}
