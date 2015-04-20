<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\General;
use App\Group;
use App\Role;
use App\Activity;
use App\Http\Requests\CreateGroupRequest;
use Session;
use Auth;
use Carbon\Carbon;

class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(General $general)	{
		$theme = $general->theme();

		$groups = Group::all();
		$count = 1;

		$theme['title'] = 'Groups';
		$theme['description'] = 'description for groups menu';

		return view('admin.group.index', compact('theme', 'groups', 'count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(General $general, Group $group) {
		$theme = $general->theme();

		$roles = Role::orderBy('level')->lists('name', 'id');

		$theme['title'] = 'Create Group';
		$theme['description'] = 'description for groups menu';

		$button_text = 'Add Group';

		return view('admin.group.create', compact('theme', 'group', 'roles', 'button_text'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateGroupRequest $request) {
		$group = Group::create($request->all());

		$auth = Auth::user();
		Activity::create([
			'text' => $auth->linkedName().' created '.$group->linkedName(),
			'user_id' => $auth->id
		]);
		Session::flash('flash_message', 'Your group has been created!');
		
		return redirect('/admin/group');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(General $general, Group $group) {
		$theme = $general->theme();

		$role = $group->role;
		$users = $group->users->toArray();

		$theme['title'] = 'Show Group';
		$theme['description'] = 'here single group and users for this group are shown';

		return view('admin.group.show', compact('theme', 'group', 'role', 'users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(General $general, Group $group) {
		$theme = $general->theme();

		$roles = Role::orderBy('level')->lists('name', 'id');

		$theme['title'] = 'Edit Group';
		$theme['description'] = 'edit group entry';

		$button_text = 'Update Group';

		return view('admin.group.edit', compact('theme', 'group', 'roles', 'button_text'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CreateGroupRequest $request, Group $group) {
		$group->updated_at = Carbon::now();
		$group->update($request->all());

		Session::flash('flash_message', $group->linkedName().' has been updated');
		
		return redirect('/admin/group');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Group $group) {
		$group->delete();

		Session::flash('flash_message', 'Your group has been deleted!');
		Session::flash('flash_message_important', 'true');

		return redirect('/admin/group');
	}

}
