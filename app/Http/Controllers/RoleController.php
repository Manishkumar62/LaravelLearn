<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\Category;
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

}
