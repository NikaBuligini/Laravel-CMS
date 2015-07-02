<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\General;

use App\Menu;
use App\Content;

use Illuminate\Http\Request;

class ContentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, Request $request) {
		$theme = $general->theme();

		$menu = Menu::findOrFail($request['menu']);

		$content = new Content();

		$types = [
			'0' => '---',
			'1' => 'Static',
			'2' => 'Dynamic',
			'3' => 'URL'
		];

		$theme['title'] = 'Create Content';
		$theme['description'] = 'description for content creation';

		$button_text = 'Create Content';

		return view('admin.content.create', compact('theme', 'menu', 'content', 'types', 'button_text'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
