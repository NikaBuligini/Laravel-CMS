<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'banners';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'url', 'image', 'order'];

	public function generateOrder() {
		$max = \DB::table($this->table)->max('order');

		if (!$max) {
			$this->order = '1';
		} else {
			$this->order = (string)++$max;
		}
	}

	public function linkedName() {
		return '<a href="'.action('Admin\BannerController@show', ['banner' => $this->id]).'">'.$this->name.'</a>';
	}
}
