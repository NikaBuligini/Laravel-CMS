<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('calculate', 'WelcomeController@calculate');
Route::post('postCalculate', 'WelcomeController@postCalculate');

Route::get('web', 'WelcomeController@web');
Route::get('mdl', 'WelcomeController@mdl');

// Route::get('home', 'HomeController@index');

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', 'Auth\AuthController@index');
	Route::get('home', 'HomeController@index');
	Route::post('ajax/navigation_position', 'Admin\AjaxController@changeNavigation');
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);

	Route::group(['middleware' => 'auth'], function() {
		Route::resource('menu', 'Admin\MenuController');
		Route::post('menu/updateOrder', 'Admin\MenuController@updateMenuOrder');
		Route::post('menu/ajaxStore', 'Admin\MenuController@ajaxStore');
		Route::post('menu/ajaxDestroy', 'Admin\MenuController@ajaxDestroy');
		Route::post('menu/getMenus', 'Admin\MenuController@getMenuSortableList');

		Route::resource('content', 'Admin\ContentController');
		
		Route::resource('group', 'Admin\GroupController');
		Route::get('group/{group}/destroy', 'Admin\GroupController@destroy');

		Route::resource('user', 'Admin\UserController');
		Route::get('user/{id}/destroy', 'Admin\UserController@destroy');
		Route::get('user/{user}/block', 'Admin\UserController@block');
		Route::get('user/{user}/unblock', 'Admin\UserController@unblock');

		Route::resource('settings', 'Admin\SettingController');
	});
});

Route::group(['prefix' => 'media'], function() {
	Route::get('files', 'Admin\FileManagerController@index');
	Route::controller('filemanager', 'FilemanagerLaravelController');
});

Route::get('{slug}', 'WelcomeController@slug');