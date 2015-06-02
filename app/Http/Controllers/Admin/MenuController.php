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
use App\Commands\UpdateMenuOrderCommand;

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
		$menuStatuses = MenuStatus::orderBy('id')->lists('name_en', 'id');
		$menuLocations = MenuLocation::orderBy('id')->lists('name_en', 'id');

		$base_header = new Menu();
		$base_header->id = 0;
		$base_header->location_id = 1;

		$base_footer = new Menu();
		$base_footer->id = 0;
		$base_footer->location_id = 2;

		$theme['title'] = 'Menu';
		$theme['description'] = 'desc';

		return view('admin.menu.index', compact('theme', 'menu', 'header', 'footer', 
			'menuStatuses', 'menuLocations', 'base_header', 'base_footer'));
	}


	// ajax function
	public function updateMenuOrder(Request $request) {
		$parent = Menu::find($request->parent);

		$this->dispatch(new UpdateMenuOrderCommand(Auth::user(), $parent, $request->order));

		if ($parent) {
			$message = 'All changes saved for '.$parent->linkedName().' children menu list';
		} else {
			$message = 'All changes saved for Base';
		}

		return ['success' => true, 'message' => $message];
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, Request $request) {
		$theme = $general->theme();

		$menu = Menu::find($request->parent);

		if (!$menu) {
			$menu = new Menu();
			$menu->parent_id = 0;

			if ($request->location) {
				switch ($request->location) {
					case 'header':
						$menu->location_id = '1';
						break;

					case 'footer':
						$menu->location_id = '2';
						break;
					
					default:
						$menu->location_id = '1';
						break;
				}
			}
		} else {
			$menu->name_ka = '';
			$menu->name_en = '';
			$menu->name_ru = '';
			$menu->slug = '';
			$menu->parent_id = $menu->id;
		}
		// dd($menu);

		// $menus = Menu::orderBy('location_id')->lists('name_en', 'id');
		// $menus[0] = "<No Parent>";
		// ksort($menus);
		
		$menuStatuses = MenuStatus::orderBy('id')->lists('name_en', 'id');
		$menuLocations = MenuLocation::orderBy('id')->lists('name_en', 'id');

		$theme['title'] = 'Create Menu';
		$theme['description'] = 'description for menus creation';

		$button_text = 'Add Menu';

		return view('admin.menu.create', compact('theme', 'menu', 'menuStatuses', 'menuLocations', 'button_text'));
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

	public function ajaxStore(CreateMenuRequest $request) {
		var_dump($request);
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
