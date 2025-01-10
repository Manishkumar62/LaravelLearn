<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'role' => 'required|string|max:20',
        ]);
        Role::create([
            'name' => $validatedData['role']
        ]);

        return redirect()->route('role.list');
    }

    public function list()
    {
        $roles = Role::paginate(5);
        return view('role.list', compact('roles'));
    }

    public function remove(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $role = Role::findOrFail($request->role_id);
        $user = User::findOrFail($request->user_id);

        // Detach the role from the user
        $role->users()->detach($user->id);

        return redirect()->route('role.list')->with('success', "User has been removed from the role.");
    }
}
