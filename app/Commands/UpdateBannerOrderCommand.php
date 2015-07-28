<?php namespace App\Commands;

use App\Commands\Command;

use App\Activity;
use App\Banner;
use App\User;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class UpdateBannerOrderCommand extends Command implements SelfHandling {

	protected $auth;

	protected $order;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $order) {
		$this->auth = $user;
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
			$banner = Banner::findOrFail($order[$i]);
			$temp_order = $i + 1;

			if ($banner->order != $temp_order) {
				$banner->order = $temp_order;
				$banner->save();
			}
		}

		Activity::create([
			'text' => $this->auth->linkedName().' updated order for banners',
			'user_id' => $this->auth->id
		]);
	}

}
