<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\General;

use App\Menu;
use App\Content;
use App\ContentType;
use App\Category;

use Auth;
use Session;

use Illuminate\Http\Request;
use App\Http\Requests\CreateContentRequest;
use App\Http\Requests\UpdateContentRequest;

use App\Commands\CreateContentCommand;
use App\Commands\UpdateContentCommand;

class ContentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(General $general) {
		$theme = $general->theme();

		$theme['title'] = 'Contents';
		$theme['description'] = '';

		return view('admin.content.index', compact('theme'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, Request $request) {
		$theme = $general->theme();

		$menu = Menu::find($request['menu']);
		$menus = null;

		if (!$menu) {
			$menus = Menu::all()->lists('name_en', 'id');
		}

		$content = new Content();

		$types = ContentType::chooseTypes();

		$categories = Category::chooseCategories();

		$theme['title'] = 'Create Content';
		$theme['description'] = 'description for content creation';

		return view('admin.content.create', compact('theme', 'menu', 'menus', 'content', 'types', 'categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateContentRequest $request) {
		$this->dispatch(new CreateContentCommand(Auth::user(), $request));

		if ($request['command_executed']) {
			return Menu::find($request->menu_id) ? redirect('/admin/menu/'.$request->menu_id) : redirect('/admin/content');
		} else {
			Session::flash('flash_fail', 'true');
			Session::flash('flash_message', 'You cannot add content with this type');
			return redirect()->back();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(General $general, Content $content) {
		$theme = $general->theme();

		$type = $content->type;

		$theme['title'] = $content->name_en;
		$theme['description'] = '';

		return view('admin.content.show', compact('theme', 'content', 'type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(General $general, Content $content) {
		$theme = $general->theme();

		$menu = $content->menu;
		$menus = null;

		if (!$menu) {
			$menus = Menu::all()->lists('name_en', 'id');
		}

		$types = ContentType::chooseTypes();

		$categories = Category::chooseCategories();

		$theme['title'] = 'Update Content';
		$theme['description'] = 'description for content creation';

		$button_text = 'Update Content';

		return view('admin.content.edit', compact('theme', 'menu', 'menus', 'content', 'types', 'categories', 'button_text'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateContentRequest $request, Content $content) {
		$this->dispatch(new UpdateContentCommand(Auth::user(), $content, $request));

		return redirect('/admin/content/'.$content->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Content $content) {
		$menu = $content->menu;

		if ($content->slug) {
			$content->slug->delete();
		}
		$content->delete();

		Session::flash('flash_message', 'Your content has been deleted!');
		Session::flash('flash_message_important', 'true');

		return redirect('/admin/menu/'.$menu->id);
	}

}
