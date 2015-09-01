<?php namespace App\Services;

use Auth;
use URL;

use App\Menu;
use App\Banner;
use App\Carousel;

class Web {

	private $social_urls = [
		'facebook' => 'https://www.facebook.com/',
		'twitter' => '#',
		'google_p' => '#',
		'youtube' => '#',
	];

	protected $header_menus;
	protected $footer_menus = [];

	protected $carousel;

	protected $basic_banners;
	protected $partner_banners;

	protected $projects;
	
	function __construct() {
		
	}

	public function getURL($target) {
		if (array_key_exists($target, $this->social_urls)) {
			return '<a href="'.$this->social_urls[$target].'" target="_blank" class="social '.$target.'"></a>';
		}

		return '#';
	}

	public function getHeaderMenus() {
		return $this->generateMenus('h');
	}

	public function getFooterMenus() {
		if (!$this->footer_menus) {
			$raw_data = Menu::footer()->active()->get();

			foreach ($raw_data as $menu) {
				if ($menu->parent_id == 0) {
					array_push($this->footer_menus, $menu);
				}
			}
			
		}

		return $this->footer_menus;
	}

	private function generateMenus($location) {
		$data = [];
		$query;

		if ($location == 'h') {
			$query = Menu::header();
		} else if ($location == 'f') {
			$query = Menu::footer();
		}

		$data = $query->active()->get();

		return $this->linkChildren($data);
	}

	private function linkChildren($data, $parent_id = 0) {
		$result = [];

		foreach ($data as $key => $item) {
			if ($item->parent_id == $parent_id) {
				$menu = new MenuHolder($item['name_en'], $item->slug->name, $item->contents);
				unset($data[$key]);
				$menu->setChildren($this->linkChildren($data, $item->id));

				array_push($result, $menu);
			}
		}

		return $result;
	}

	public function renderMenus($menus) {
		$html = '';

		foreach ($menus as $item) {
			$contents = $item->contents;

			$target = '#';
			$class = count($item->children) > 0 ? ' class="hasGeneration"' : '';

			if (!$contents->isEmpty()) {
				$first_content = $contents->first();

				if ($first_content->type->isURL()) {
					$target = $first_content->url;
				} else if ($first_content->type->isStatic()) {
					$target = URL::to('/'.$first_content->slug->name);
				} else {
					$target = URL::to('/'.$item->slug);
				}
			}

			$html .= '<li>'.'<a href="'.$target.'"'.$class.'>'.$item->name.'</a>';

			$children_html = $this->renderMenus($item->children);

			if (strlen($children_html) > 0) {
				$html .= '<ul>'.$children_html.'</ul>';
			}

			$html .= '</li>';
		}

		return $html;
	}

	public function carousel() {
		if (!$this->carousel) {
			$this->carousel = Carousel::orderBy('order')->get();
		}

		return $this->carousel;
	}

	public function banners() {
		if (!$this->basic_banners) {
			$this->basic_banners = Banner::basics()->get();
		}

		return $this->basic_banners;
	}

	public function partners() {
		if (!$this->partner_banners) {
			$this->partner_banners = Banner::partners()->get();
		}
		
		return $this->partner_banners;
	}

	public function projects() {
		if (!$this->projects) {
			$projects_menu = Menu::where('id', 2)->get();

			if (!$projects_menu->isEmpty()) {
				$this->projects = $projects->contents->sortByDesc(function($content) 
				{
					return $content->publish_date;
				});
			}
		}

		dd($this->projects);
		return $this->projects;
	}
}

class MenuHolder {

	public $name;

	public $slug;

	public $contents;

	public $children;

	function __construct($name, $slug, $contents = null) {
		$this->name = $name;
		$this->slug = $slug;
		$this->contents = $contents;

		$this->children = [];
	}

	public function setChildren($children) {
		$this->children = $children;
	}
}