<?php namespace App\Services;

use Auth;
use URL;

use App\Menu;

class Web {

	protected $header_menus;
	
	function __construct() {
		
	}

	public function getHeaderMenus() {
		return $this->generateMenus('h');
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
				$target = $url ? $url : '/'.$item->slug;
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