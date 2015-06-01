<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLocation extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_locations';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name_ka', 'name_en', 'name_ru'];

	public function menus() {
		return $this->hasMany('App\Menu');
	}

}
