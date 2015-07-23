<?php namespace App\Services;

use Auth;
use URL;

use App\Menu;

class Web {

	private $social_urls = [
		'facebook' => 'https://www.facebook.com/',
		'twitter' => '#',
		'google_p' => '#',
		'youtube' => '#',
	];

	protected $header_menus;
	protected $footer_menus = [];
	
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
				$url = $contents->first()->url;
				$target = $url ? $url : URL::to('/'.$item->slug);
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