<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

use App\Menu;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Validator::extend('correct_type', function($attribute, $value, $parameters) {
			$contents = Menu::findOrFail($parameters[0])->contents;

			if (!$contents->isEmpty()) {
				$first_type = $contents->first()->type;

				return $first_type->isDynamic() ? $value == $first_type->dynamic_type : false;
			}

            return true;
        });
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
