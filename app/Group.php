<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'role_id'];


	public function role() {
		return $this->belongsTo('App\Role');
	}

	public function users() {
		return $this->hasMany('App\User');
	}

	public function registration_links() {
		return $this->hasMany('App\RegistrationLink');
	}

	public function linkedName() {
		return '<a href="'.action('Admin\GroupController@show', ['group' => $this->id]).'">'.$this->name.'</a>';
	}
}
