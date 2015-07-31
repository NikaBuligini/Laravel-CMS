<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\General;

use App\Banner;
use App\BannerType;

use Auth;
use Session;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

use App\Commands\CreateBannerCommand;
use App\Commands\UpdateBannerCommand;
use App\Commands\UpdateBannerOrderCommand;

class BannerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(General $general, Request $request) {
		$theme = $general->theme();

		$type = $request['type'] ? BannerType::findOrFail($request['type']) : BannerType::find(1);

		$banners = $type->banners->sortBy(function($banner)	{
			return $banner->order;
		});

		$theme['title'] = $type->name.' Banners';
		$theme['description'] = '';

		return view('admin.banner.index', compact('theme', 'banners', 'type'));
	}

	// ajax function
	public function updateBannerOrder(Request $request) {
		$this->dispatch(new UpdateBannerOrderCommand(Auth::user(), $request->order));

		$message = 'Banners order has been updated!';

		return ['success' => true, 'message' => $message];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, Request $request) {
		$theme = $general->theme();

		$type = $request['type'] ? BannerType::findOrFail($request['type']) : BannerType::find(1);

		$banner = new Banner();

		$theme['title'] = 'Create '.$type->name.' Banner';
		$theme['description'] = '';

		return view('admin.banner.create', compact('theme', 'banner', 'type'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateBannerRequest $request) {
		$this->dispatch(new CreateBannerCommand(Auth::user(), $request));

		$type = $request['banner_type_id'] ? BannerType::findOrFail($request['banner_type_id']) : BannerType::find(1);

		return redirect('/admin/banner?type='.$type->id);
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
	public function edit(General $general, Banner $banner) {
		$theme = $general->theme();

		$type = $banner->type;

		$theme['title'] = 'Update '.$banner->name.' Banner';
		$theme['description'] = '';

		return view('admin.banner.edit', compact('theme', 'banner', 'type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateBannerRequest $request, Banner $banner) {
		$this->dispatch(new UpdateBannerCommand(Auth::user(), $banner, $request));

		$type = $banner->type;

		return redirect('/admin/banner?type='.$type->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Banner $banner) {
		$banner->delete();

		Session::flash('flash_message', 'Your banner has been deleted!');
		Session::flash('flash_message_important', 'true');

		return redirect('/admin/banner');
	}

}
