<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateMenuRequest;
use App\Activity;
use App\Menu;
use App\User;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class UpdateMenuOrderCommand extends Command implements SelfHandling {

	protected $auth;

	protected $parent;

	protected $order;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $parent, $order) {
		$this->auth = $user;
		$this->parent = $parent;
		$this->order = $order;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$order = $this->order;

		for ($i = 0; $i < count($order); $i++) {
			$menu = Menu::findOrFail($order[$i]);
			$temp_order = $i + 1;

			if ($menu->order != $temp_order) {
				$menu->order = $temp_order;
				$menu->save();
			}
		}

		if (!$this->parent) {
			$parent_link = 'Base menu';
		} else {
			$parent_link = $this->parent->linkedName();
		}

		Activity::create([
			'text' => $this->auth->linkedName().' updated order for '.$parent_link."'s children menu list",
			'user_id' => $this->auth->id
		]);
	}

}
