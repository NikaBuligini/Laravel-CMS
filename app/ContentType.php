<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model {

	protected $table = 'content_types';

	protected $fillable = ['name'];

	public function contents() {
		return $this->hasMany('App\Content');
	}
}
