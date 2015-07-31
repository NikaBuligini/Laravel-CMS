<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerType extends Model {

	public $basic = 1;
	public $partner = 2;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'banner_types';

	public static function type($name) {
		switch ($name) {
			case 'basic':
				return 1;
				break;

			case 'partner':
				return 2;
				break;
			
			default:
				return 0;
				break;
		}
	}

	public function banners() {
		return $this->hasMany('App\Banner');
	}

}
