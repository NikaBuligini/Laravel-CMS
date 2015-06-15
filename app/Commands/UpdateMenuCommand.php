<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\UpdateMenuRequest;
use App\Activity;
use App\Menu;
use App\User;
use Session;
use Carbon\Carbon;

use Illuminate\Contracts\Bus\SelfHandling;

class UpdateMenuCommand extends Command implements SelfHandling {

	protected $auth;

	protected $menu;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Menu $menu, UpdateMenuRequest $request) {
		$this->auth = $user;
		$this->menu = $menu;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$this->menu->updated_at = Carbon::now();
		$this->menu->update($this->request->all());

		Activity::create([
			'text' => $this->auth->linkedName().' updated menu named '.$this->menu->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'You have updated menu!');
	}

}
