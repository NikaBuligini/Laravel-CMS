<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\UpdateBannerRequest;
use App\Activity;
use App\Banner;
use App\User;
use Session;
use Carbon\Carbon;

use Illuminate\Contracts\Bus\SelfHandling;

class UpdateBannerCommand extends Command implements SelfHandling {

	protected $auth;

	protected $banner;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Banner $banner, UpdateBannerRequest $request) {
		$this->auth = $user;
		$this->banner = $banner;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$this->banner->updated_at = Carbon::now();
		$this->banner->update($this->request->all());

		Activity::create([
			'text' => $this->auth->linkedName().' updated banner named '.$this->banner->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'You have updated banner!');
	}

}
