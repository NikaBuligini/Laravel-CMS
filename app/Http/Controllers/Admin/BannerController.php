<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\General;

use App\Banner;

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
	public function index(General $general) {
		$theme = $general->theme();

		$banners = Banner::orderBy('order')->get();

		$theme['title'] = 'Banners';
		$theme['description'] = '';

		return view('admin.banner.index', compact('theme', 'banners'));
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
	public function create(General $general) {
		$theme = $general->theme();

		$banner = new Banner();

		$theme['title'] = 'Create Banner';
		$theme['description'] = '';

		return view('admin.banner.create', compact('theme', 'banner'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateBannerRequest $request) {
		$this->dispatch(new CreateBannerCommand(Auth::user(), $request));

		return redirect('/admin/banner');
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

		$theme['title'] = 'Update '.$banner->name.' Banner';
		$theme['description'] = '';

		return view('admin.banner.edit', compact('theme', 'banner'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateBannerRequest $request, Banner $banner) {
		$this->dispatch(new UpdateBannerCommand(Auth::user(), $banner, $request));

		return redirect('/admin/banner');
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
