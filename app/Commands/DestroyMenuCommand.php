<?php namespace App\Commands;

use App\Commands\Command;

use App\Activity;
use App\Menu;
use App\User;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class DestroyMenuCommand extends Command implements SelfHandling {

	protected $auth;

	protected $target;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Menu $target) {
		$this->auth = $user;
		$this->target = $target;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$this->target->delete();

		Activity::create([
			'text' => $this->auth->linkedName().' removed '.$this->target->linkedName(),
			'user_id' => $this->auth->id
		]);
	}

}
