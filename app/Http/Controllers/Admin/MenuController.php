<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\General;

use Auth;

use App\Menu;
use App\MenuStatus;
use App\MenuLocation;
use App\Http\Requests\CreateMenuRequest;
use App\Commands\CreateMenuCommand;

use Illuminate\Http\Request;

class MenuController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(General $general) {
		$theme = $general->theme();

		$header = Menu::header()->get();
		$footer = Menu::footer()->get();
		$menu = new Menu();
		$menu->id = 0;
		// $menu->renderChildren('header');
		// $menu->renderSortableHeader($header);

		$theme['title'] = 'Menu';
		$theme['description'] = 'desc';

		return view('admin.menu.index', compact('theme', 'menu', 'header', 'footer'));
	}


	// ajax function
	public function updateMenuOrder(Request $request) {
		$order = $request->order;
		$result = array();

		for ($i = 0; $i < count($order); $i++) {
			$menu = Menu::findOrFail($order[$i]);
			$temp_order = $i + 1;

			if ($menu->order != $temp_order) {
				$menu->order = $temp_order;
				$menu->save();
			}
		}

		return ['success' => true];
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, Menu $menu, Request $request) {
		$theme = $general->theme();

		$menus = Menu::orderBy('location_id')->lists('name_en', 'id');
		$menus[0] = "<No Parent>";
		ksort($menus);
		// dd($menus);
		$hide_location = false;
		if ($request->location) {
			switch ($request->location) {
				case 'header':
					$hide_location = true;
					$menu->location_id = '1';
					break;

				case 'footer':
					$hide_location = true;
					$menu->location_id = '2';
					break;
				
				default:
					# code...
					break;
			}
		}

		$initial = true;
		
		$menuStatuses = MenuStatus::orderBy('id')->lists('name_en', 'id');
		$menuLocations = MenuLocation::orderBy('id')->lists('name_en', 'id');

		$theme['title'] = 'Create Menu';
		$theme['description'] = 'description for menus creation';

		$button_text = 'Add Menu';

		return view('admin.menu.create', compact('theme', 'menu', 'initial', 'menus', 'menuStatuses', 
			'hide_location', 'menuLocations', 'button_text'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateMenuRequest $request) {
		$this->dispatch(new CreateMenuCommand(Auth::user(), $request));
		
		return redirect('/admin/menu');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
