<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slugs';

	protected $fillable = array('name', 'slug_attribute_id');

	public function menu() {
		return $this->hasOne('App\Menu');
	}

}
