<?php namespace App\Http\Controllers;

use App\Services\General;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(General $general) {
		$theme = $general->theme();

		$theme['title'] = 'Home';
		$theme['description'] = 'main page of admin panel';

		return view('admin.dashboard', compact('theme'));
	}

}
