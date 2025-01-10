<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function list($name = null)
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all(); // Fetch all available roles
        return view('user.list', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        // Attach the role to the user
        $user->roles()->attach($role);

        return redirect()->back()->with('success', 'Role assigned successfully!');
    }

}
