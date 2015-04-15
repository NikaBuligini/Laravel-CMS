<?php namespace App\Services;

use Auth;
use URL;

class General {
	
	protected $theme;
	
	function __construct() {
		$this->generateContainerClasses();
	}

	public function theme() {
		return $this->theme;
	}

	private function generateContainerClasses() {
		$wide_nav = session('wide_nav');
		if ($wide_nav == 'true') {
			$this->theme['left_nav_class'] = "nav-small";
			$this->theme['right_container_class'] = "wide-page";
		} else {
			$this->theme['left_nav_class'] = "nav-wide";
			$this->theme['right_container_class'] = "";
		}

		$this->theme['user-name'] = Auth::user()->name;
		$this->theme['user-profile-image'] = URL::to('uploads/users/cthulhu.jpg');
	}
}
