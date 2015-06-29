<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contents';

	public function menu() {
		return $this->belongsTo('App\Menu');
	}

}
