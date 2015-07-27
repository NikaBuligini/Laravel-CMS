<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\UpdateContentRequest;
use App\Activity;
use App\Content;
use App\User;
use App\Slug;
use Session;
use Carbon\Carbon;

use Illuminate\Contracts\Bus\SelfHandling;

class UpdateContentCommand extends Command implements SelfHandling {

	const SLUG_ATTRIBUTE_MENU = 2;

	protected $auth;

	protected $content;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Content $content, UpdateContentRequest $request) {
		$this->auth = $user;
		$this->content = $content;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$current_timestamp = Carbon::now();

		$this->content->slug->updated_at = $current_timestamp;
		$this->content->slug->update(['name' => $this->request->slug]);

		$this->content->updated_at = $current_timestamp;
		$this->content->update($this->request->all());

		Activity::create([
			'text' => $this->auth->linkedName().' updated content named '.$this->content->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'You have updated content!');
	}

}
