<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class RegistrationLink extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registration_links';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['_token', 'group_id', 'valid_until'];


	public function scopeValid($query) {
		$query->where('valid_until', '>=', Carbon::now());
	}

	public function scopeInvalid($query) {
		$query->where('valid_until', '<', Carbon::now());
	}


	public function group() {
		return $this->belongsTo('App\Group');
	}

}
