<?php namespace App\Commands;

use App\Commands\Command;

use App\Activity;
use App\Carousel;
use App\User;

use Auth;
use Session;

use Illuminate\Http\Request;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateCarouselCommand extends Command implements SelfHandling {

	protected $auth;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Request $request) {
		$this->auth = $user;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$carousel = new Carousel($this->request->all());
		$carousel->generateOrder();

		$carousel->save();

		Activity::create([
			'text' => $this->auth->linkedName().' created new image for slider',
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'Your image has been added to slider!');
	}

}
