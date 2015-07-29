<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\General;

use App\Carousel;

use Auth;
use Session;
use Validator;

use Illuminate\Http\Request;

use App\Commands\CreateCarouselCommand;
use App\Commands\UpdateCarouselOrderCommand;
use App\Commands\DestroyCarouselCommand;

class CarouselController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(General $general)	{
		$theme = $general->theme();

		$carousels = Carousel::orderBy('order')->get();

		$theme['title'] = 'Slider';
		$theme['description'] = 'add/remove or reorder slider images';

		return view('admin.carousel.index', compact('theme', 'carousels'));
	}

	public function updateCarouselOrder(Request $request) {
		$this->dispatch(new UpdateCarouselOrderCommand(Auth::user(), $request->order));

		$message = 'Slider order has been updated!';

		return ['success' => true, 'message' => $message];
	}

	public function ajaxDestroy(Request $request) {
		$validator = Validator::make($request->all(), ['item_id' => 'required|min:1|exists:carousels,id']);

		if ($validator->fails()) {
			return ['success' => false, 'message' => $validator->errors()->first('item_id')];
		}

		$this->dispatch(new DestroyCarouselCommand(Auth::user(), Carousel::findOrFail($request['item_id'])));

		return ['success' => true, 'id' => $request['item_id']];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general) {
		$theme = $general->theme();

		$carousel = new Carousel();

		$theme['title'] = 'Create Slider Image';
		$theme['description'] = '';

		return view('admin.carousel.create', compact('theme', 'carousel'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)	{
		$this->validate($request, [
			'image' => 'required|url'
		]);

		$this->dispatch(new CreateCarouselCommand(Auth::user(), $request));

		return redirect('/admin/carousel');
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
