<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contents';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['menu_id', 'type_id', 'slug_id', 'url', 'static_file_name', 'image',
		'name_ka', 'name_en', 'name_ru', 'description_ka', 'description_en', 'description_ru',
		'body_ka', 'body_en', 'body_ru', 'gallery', 'publish_date'];

	public function menu() {
		return $this->belongsTo('App\Menu');
	}

	public function slug() {
		return $this->belongsTo('App\Slug');
	}

	public function type() {
		return $this->belongsTo('App\ContentType');
	}

	public function linkedName() {
		return '<a href="'.action('Admin\ContentController@show', ['content' => $this->id]).'">'.$this->name_en.'</a>';
	}
}
