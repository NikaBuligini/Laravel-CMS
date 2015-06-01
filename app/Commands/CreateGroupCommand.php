<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateGroupRequest;
use App\Activity;
use App\Group;
use App\User;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateGroupCommand extends Command implements SelfHandling {

	protected $auth;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, CreateGroupRequest $request) {
		$this->auth = $user;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$group = Group::create($this->request->all());

		Activity::create([
			'text' => $this->auth->linkedName().' created '.$group->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'Your group has been created!');
	}

}
