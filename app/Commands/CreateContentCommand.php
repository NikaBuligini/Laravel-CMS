<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateContentRequest;
use App\Activity;
use App\Content;
use App\Menu;
use App\User;
use App\Slug;
use Session;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateContentCommand extends Command implements SelfHandling {

	const SLUG_ATTRIBUTE_MENU = 2;

	protected $auth;

	protected $request;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, CreateContentRequest $request) {
		$this->auth = $user;
		$this->request = $request;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$slug = Slug::create([
			'name' => $this->request->slug,
			'slug_attribute_id' => self::SLUG_ATTRIBUTE_MENU
		]);
		$this->request['slug_id'] = $slug->id;
		$this->request['gallery'] = ''; // not yet implemented

		$content = Content::create($this->request->all());

		Activity::create([
			'text' => $this->auth->linkedName().' created new content named '.$content->linkedName(),
			'user_id' => $this->auth->id
		]);
		Session::flash('flash_message', 'Your content has been created!');
	}

}
