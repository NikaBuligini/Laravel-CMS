<?php namespace App\Commands;

use App\Commands\Command;

use App\Activity;
use App\Carousel;
use App\User;
use Session;


use Illuminate\Contracts\Bus\SelfHandling;

class DestroyCarouselCommand extends Command implements SelfHandling {

	protected $auth;

	protected $target;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Carousel $target) {
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
			'text' => $this->auth->linkedName().' removed slider image',
			'user_id' => $this->auth->id
		]);
	}

}
