<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activities';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['text', 'user_id'];


	public function owner() {
		return $this->belongsTo('App\User');
	}

}
