<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\CreateContentRequest;
use App\Activity;
use App\Content;
use App\ContentType;
use App\Menu;
use App\User;
use App\Slug;
use Session;

use Illuminate\Contracts\Validation\ValidationException;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateContentCommand extends Command implements SelfHandling {

	const STATIC_TYPE = 1;
	const DYNAMIC_TYPE = 2;
	const URL_TYPE = 3;

	const SLUG_ATTRIBUTE_MENU = 2;

	protected $isValid = true;

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

		$request['isValid'] = true;

		$menu = Menu::findOrFail($request->menu_id);
		$contents = $menu->contents;

		if (!$contents->isEmpty()) {
			$first_type = $contents->first()->type;

			if (!$first_type->isDynamic()) {
				$this->isValid = false;
			}
		}
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		if ($this->isValid) {
			$this->request['gallery'] = ''; // not yet implemented

			if ($this->request->slug) {
				$slug = Slug::create([
					'name' => $this->request->slug,
					'slug_attribute_id' => self::SLUG_ATTRIBUTE_MENU
				]);
				$this->request['slug_id'] = $slug->id;
			} else {
				$this->request['slug_id'] = '';
			}

			$this->clearExtraParameters();

			$content = Content::create($this->request->all());

			Activity::create([
				'text' => $this->auth->linkedName().' created new content named '.$content->linkedName(),
				'user_id' => $this->auth->id
			]);
			Session::flash('flash_message', 'Your content has been created!');
		}

		$this->request['command_executed'] = $this->isValid;
	}

	private function clearExtraParameters() {
		$type = ContentType::findOrFail($this->request['type_id']);

		if ($type->isDynamic()) {
			$this->clearStatic();
			$this->clearURL();
		} else if ($type->isURL()) {
			$request['slug'] = '';
			$this->clearStatic();
			$this->clearDynamic();
		} else if ($type->isStatic()) {
			$this->clearURL();
			$this->clearDynamic();
		}
	}

	private function clearStatic() {
		$this->request['static_file_name'] = '';
	}

	private function clearDynamic() {
		$this->request['name_ka'] = '';
		$this->request['name_en'] = '';
		$this->request['name_ru'] = '';
		$this->request['publish_date'] = '';
		$this->request['image'] = '';
		$this->request['description_ka'] = '';
		$this->request['description_en'] = '';
		$this->request['description_ru'] = '';
		$this->request['body_ka'] = '';
		$this->request['body_en'] = '';
		$this->request['body_ru'] = '';
	}

	private function clearURL() {
		$this->request['url'] = '';
	}

}
