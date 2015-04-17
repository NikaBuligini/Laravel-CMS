<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\General;
use App\User;
use App\Group;
use App\Activity;
use App\RegistrationLink;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Carbon\Carbon;
use Auth;
use Session;
use URL;
use Input;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(General $general) {
		$theme = $general->theme();

		$users = User::all();
		$count = 1;

		$theme['title'] = 'Users';
		$theme['description'] = 'description for users menu';

		return view('admin.user.index', compact('theme', 'users', 'count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, User $user) {
		$theme = $general->theme();

		$registration_links = RegistrationLink::valid()->get();
		$groups = Group::orderBy('role_id')->lists('name', 'id');

		$theme['title'] = 'Create User';
		$theme['description'] = 'Here you generate link which will be used by another user for sign up';

		$button_text = 'Generate User Register Link';

		return view('admin.user.create', compact('theme', 'user', 'registration_links', 'groups', 'button_text'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request) {
		$token = str_random(40);

		$result = RegistrationLink::where('_token', $token)->first();

		while($result != null) {
			$token = str_random(40);
			$result = RegistrationLink::where('_token', $token)->first();
		}

		$request['_token'] = $token;
		$request['valid_until'] .= ' 23:59:59';

		$group = Group::findOrFail($request->group_id);

		RegistrationLink::create($request->all());

		Session::flash('flash_message', 'New registration link for "'.$group->name.'" group member has been created!<br>
			Registration link is <a href="'.URL::to('admin/auth/register?_token='.$request['_token'])
			.'">here</a>. You can send it to person you want to register as an administrator.');
		Session::flash('flash_secondary', 'true');
		Session::flash('flash_message_important', 'true');

		return redirect('/admin/user/create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(General $general, User $user) {
		// if (Auth::id() == $user->id) {
		// 	echo "Me";
		// 	dd($user);
		// } else {
		// 	echo "Other";
		// 	dd($user);
		// }
		$theme = $general->theme();

		$activities = $user->activities->reverse();
		$group = $user->group;
		$role = $group->role;

		switch (Input::get('tab')) {
			case 'activities':
				$tab = 0;
				break;
			case 'about':
				$tab = 1;
				break;
			case 'edit':
				$tab = 2;
				break;
			
			default:
				$tab = 0;
				break;
		}

		$groups = Group::lists('name', 'id');

		return view('admin.user.show', compact('theme', 'activities', 'user', 'group', 'role', 'groups', 'tab'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(General $general, User $user) {
		$theme = $general->theme();

		if ($user->id == Auth::user()->id) {
			return redirect('/admin/user/'.$user->id);
		}
		dd($user);

		$roles = Role::orderBy('level')->lists('name', 'id');

		$theme['title'] = 'Edit User';
		$theme['description'] = 'edit user entry';

		$button_text = 'Update User';

		return view('admin.group.edit', compact('theme', 'group', 'roles', 'button_text'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateUserRequest $request, User $user) {
		$request->active != null ? $request['active'] = '1' : $request['active'] = '0';

		$user->updated_at = Carbon::now();
		$user->update($request->all());

		Session::flash('flash_message', 'User has been updated');		
		Session::flash('flash_success', 'true');		
		
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		RegistrationLink::find($id)->first()->delete();

		Session::flash('flash_message', 'Registration token has been deleted');
		Session::flash('flash_success', 'true');

		return redirect('/admin/user/create');
	}


	public function block(User $user) {
		$user->active = 0;
		$user->save();

		$auth = Auth::user();
		Activity::create([
			'text' => $auth->linkedName().' has blocked '.$user->linkedName(),
			'user_id' => $auth->id
		]);

		Session::flash('flash_message', $user->linkedName().' has been blocked');
		Session::flash('flash_success', 'true');

		return redirect()->back();
	}


	public function unblock(User $user) {
		$user->active = 1;
		$user->save();

		$auth = Auth::user();
		Activity::create([
			'text' => $auth->linkedName().' has unblocked '.$user->linkedName(),
			'user_id' => $auth->id
		]);

		Session::flash('flash_message', $user->linkedName().' has been unblocked');
		Session::flash('flash_success', 'true');

		return redirect()->back();
	}

}
