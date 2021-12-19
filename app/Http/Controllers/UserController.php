<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('modules.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('modules.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $exist = User::where('email', $data['email'])->first();

        if ($exist) {
            flash()->error($data['email'].' is already registered.');
            return redirect()->back();
        }
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user->roles()->attach($data['role_id']);

        flash()->success('User successfully registered!');
        return redirect()->route('users.index');
    }

    public function edit($userId)
    {
        $user = User::find($userId);
        if (empty($user)) {
            flash()->error('User does not exist');
            return redirect()->route('users.index');
        }
        
        $roles = Role::get();
        
        return view('modules.user.edit', compact('user', 'roles'));
    }

    public function update($userId, Request $request)
    {

        $user = User::find($userId);
        $data = $request->all();
        if (empty($user)) {
            flash()->error('User does not exist');
            return redirect()->route('users.index');
        }
        
        if (@$data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->fill($data);

        $user->save();

        $user->roles()->detach();

        $user->roles()->attach($data['role_id']);

        flash()->success('User successfully updated!');
        return redirect()->back();
    }

    public function destroy($userId)
    {

        $user = User::find($userId);
        if (empty($user)) {
            flash()->error('User does not exist');
            return redirect()->route('users.index');
        }

        $user->delete();


        flash()->success('User successfully deleted!');
        return redirect()->back();
    }
}
