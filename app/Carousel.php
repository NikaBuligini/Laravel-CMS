<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'carousels';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['image', 'order'];

	public function generateOrder() {
		$max = \DB::table($this->table)->max('order');

		if (!$max) {
			$this->order = '1';
		} else {
			$this->order = (string)++$max;
		}
	}

}
