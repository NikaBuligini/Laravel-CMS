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
	protected $fillable = ['name', 'url', 'image', 'order', 'banner_type_id'];

	public function type() {
		return $this->belongsTo('App\BannerType', 'banner_type_id');
	}

	public function generateOrder() {
		$max = \DB::table($this->table)->where('banner_type_id', $this->banner_type_id)->max('order');

		if (!$max) {
			$this->order = '1';
		} else {
			$this->order = (string)++$max;
		}
	}

	public function linkedName() {
		return '<a href="'.action('Admin\BannerController@show', ['banner' => $this->id]).'">'.$this->name.'</a>';
	}

	public function scopeBasics($query) {
		$query->where('banner_type_id', '1')->orderBy('order');
	}

	public function scopePartners($query) {
		$query->where('banner_type_id', '2')->orderBy('order');
	}
}
