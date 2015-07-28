<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateBannerRequest;
use App\Activity;
use App\Banner;
use App\User;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateBannerCommand extends Command implements SelfHandling {

	protected $auth;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, CreateBannerRequest $request) {
		$this->auth = $user;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$banner = new Banner($this->request->all());
		$banner->generateOrder();

		$banner->save();

		Activity::create([
			'text' => $this->auth->linkedName().' created new banner named '.$banner->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'Your banner has been created!');
	}

}
