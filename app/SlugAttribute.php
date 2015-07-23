<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SlugAttribute extends Model {

	const FOR_MENU = 1;
	const FOR_CONTENT = 2;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slug_attributes';

	public function slugs() {
		return $this->hasMany('App\Slug');
	}
}
