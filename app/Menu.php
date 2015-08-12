<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	const ACTIVE = 1;
	const CANCELED = 2;


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
	protected $fillable = ['name_ka', 'name_en', 'name_ru', 'order', 'parent_id', 'status_id', 'location_id', 'slug_id'];

	public function status() {
		return $this->belongsTo('App\MenuStatus');
	}

	public function location() {
		return $this->belongsTo('App\MenuLocation');
	}

	public function slug() {
		return $this->belongsTo('App\Slug');
	}

	public function contents() {
		return $this->hasMany('App\Content');
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
		$query->where('location_id', '1')->orderBy('order');
	}

	public function scopeFooter($query) {
		$query->where('location_id', '2')->orderBy('order');
	}

	public function scopeChildren($query) {
		$query->where('parent_id', $this->id);
	}

	public function scopeOrdered($query) {
		$query->orderBy('order');
	}

	public function scopeActive($query) {
		$query->where('status_id', self::ACTIVE);
	}

	public function linkedName() {
		return '<a href="'.action('Admin\MenuController@show', ['menu' => $this->id]).'">'.$this->name_en.'</a>';
	}

	public function makeHeader() {
		$this->location_id = 1;
	}

	public function renderChildren($force_location = false) {
		if ($force_location) {
			switch ($force_location) {
				case 'header':
					$location = $this->header();
					break;
				case 'footer':
					$location = $this->footer();
					break;
				default:
					throw new \Exception('Invalid force location was passed to renderChildren function');
			}
		} else {
			switch ($this->location_id) {
				case 1:
					$location = $this->header();
					break;
				case 2:
					$location = $this->footer();
					break;
				default:
					throw new \Exception('Menu model has invalid location ID');
			}
		}
		$data = $location->children()->get();

		$result = null;
		foreach ($data as $key => $item) {
			$type_cls = $item->status_id == self::CANCELED ? ' canceled' : '';
			$result .= 
				'<li id="node'.$item->order.'" class="dd-item nested-list-item" data-order="'.$item->order.'" data-id="'.$item->id.'">
					<div class="nested-list-content">
						<div class="dd-handle nested-list-handle'.$type_cls.'">
							<i class="fa fa-arrows"></i>
						</div>
						<span>'.$item->name_en.'</span>
						<div class="pull-right">
							<a href="'.url('admin/menu/'.$item->id).'">
								<i class="fa fa-eye view_toggle" rel="'.$item->id.'"></i>
							</a> | 
							<a href="'.url('admin/menu/edit/'.$item->id).'">
								<i class="fa fa-pencil edit_toggle" rel="'.$item->id.'"></i>
							</a> | 
							<i class="fa fa-times delete_toggle" rel="'.$item->id.'"></i>
						</div>
					</div>
				</li>';
		}
		
		return $result ? '<ol class="dd-list">'.$result.'</ol>' : null;
	}


	// NOT STABLE
	public function renderSortableHeader($header) {
		return $this->buildMenu($header);
		// dd($this->buildMenu($header));
	}

	public function buildMenu($menu, $parentid = 0) { 
		$result = null;
		foreach ($menu as $key => $item) {
			if ($item->parent_id == $parentid) {
				$result .= 
					'<li class="dd-item nested-list-item" data-order="'.$item->order.'" data-id="'.$item->id.'">
						<div class="nested-list-content">
							<div class="dd-handle nested-list-handle">
								<i class="fa fa-arrows"></i>
							</div>
							<span>'.$item->name_en.'</span>
							<div class="pull-right">
								<a href="'.url('admin/menu/edit/'.$item->id).'">Edit</a> |
								<a href="#" class="delete_toggle" rel="'.$item->id.'">Delete</a>
							</div>
						</div>'
						.$this->buildMenu($menu, $item->id).
					'</li>';
			}
		}

		return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : "<ol class='dd-list asd'></ol>"; 
	}
	// NOT STABLE


	public function contentsPagination() {
		return Content::where('menu_id', $this->id)->orderBy('publish_date')->paginate(5);
	}
}
