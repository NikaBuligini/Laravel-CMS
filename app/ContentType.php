<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model {

	public $static_type = 1;
	public $dynamic_type = 2;
	public $url_type = 3;

	protected $table = 'content_types';

	protected $fillable = ['name'];

	public function contents() {
		return $this->hasMany('App\Content');
	}

	public static function chooseTypes() {
		$types = ['0' => '---'];
		foreach (ContentType::all()->lists('name', 'id') as $key => $value) {
			array_push($types, $value);
		}
		return $types;
	}

	public function isStatic() {
		return $this->id == $this->static_type;
	}

	public function isDynamic() {
		return $this->id == $this->dynamic_type;
	}

	public function isURL() {
		return $this->id == $this->url_type;
	}
}
