<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateMenuRequest;
use App\Activity;
use App\Menu;
use App\User;
use App\Slug;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateMenuCommand extends Command implements SelfHandling {

	const SLUG_ATTRIBUTE_MENU = 1;

	protected $auth;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, CreateMenuRequest $request) {
		$this->auth = $user;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$slug = Slug::create([
			'name' => $this->request->slug,
			'slug_attribute_id' => self::SLUG_ATTRIBUTE_MENU
		]);
		$this->request['slug_id'] = $slug->id;
		// dd($slug);

		$menu = new Menu($this->request->all());
		$menu->generateOrder();

		if ($menu->location_id == 0) {
			$parent = Menu::findOrFail($menu->parent_id);
			$menu->location_id = $parent->location_id;
		}

		$menu->save();

		Activity::create([
			'text' => $this->auth->linkedName().' created new menu named '.$menu->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'Your menu has been created!');
	}

}
