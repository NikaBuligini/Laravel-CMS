<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateMenuRequest;
use App\Activity;
use App\Menu;
use App\User;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateMenuCommand extends Command implements SelfHandling {

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
