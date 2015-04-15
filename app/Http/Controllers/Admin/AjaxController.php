<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AjaxController extends Controller {

	/**
	 * Change left navigation look for admin panel.
	 *
	 * @return Void
	 */
	public function changeNavigation(Request $request) {
		session(['wide_nav' => $request->input('wide')]);
	}

}
