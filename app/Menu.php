<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menus';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name_ka', 'name_en', 'name_ru', 'order', 'parent_id', 'status_id', 'location_id'];

	public function status() {
		return $this->belongsTo('App\MenuStatus');
	}

	public function location() {
		return $this->belongsTo('App\MenuLocation');
	}

	public function generateOrder() {
		$max = \DB::table($this->table)->where('parent_id', $this->parent_id)->max('order');

		if (!$max) {
			$this->order = '1';
		} else {
			$this->order = (string)++$max;
		}
	}

	public function scopeHeader($query) {
		$query->where('location_id', '1');
	}

	public function scopeFooter($query) {
		$query->where('location_id', '2');
	}

	public function linkedName() {
		return '<a href="'.action('Admin\MenuController@show', ['menu' => $this->id]).'">'.$this->name_en.'</a>';
	}

	public static function renderSortableHeader($header) {
		dd($header);
	}

	public function buildMenu($menu, $parentid = 0) { 
		$result = null;
		foreach ($menu as $item) {
			if ($item->parent_id == $parentid) { 
				$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
					<div class='dd-handle nested-list-handle'>
						<span class='glyphicon glyphicon-move'></span>
					</div>
					<div class='nested-list-content'>{$item->label}
						<div class='pull-right'>
							<a href='".url("admin/menu/edit/{$item->id}")."'>Edit</a> |
							<a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
						</div>
					</div>".$this->buildMenu($menu, $item->id) . "</li>"; 
			}
		}
		return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
	}

}
