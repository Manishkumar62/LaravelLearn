<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
        ]);

        Category::create([
            'name' => $validatedData['name']
        ]);

        return redirect()->route('category.list');
    }
    public function list($name = null)
    {
        $categories = Category::paginate(5);
        // if ($category != null) {

            if (request()->ajax()) {
                $categories = Category::when($name, function($query) use($name){
                    $query->where('name', 'like', "%$name%");
                })->paginate(5);
                return response()->json($categories);
            }
        // }
        return view('category.list', compact('categories'));
    }

    public function edit($id = null)
    {
        $data = Category::findOrFail($id);
        return view('category.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
        ]);
        $id = $request->id;
        $data = Category::findOrFail($id);
        $data->update([
            'name' => $validatedData['name'],
        ]);
        return redirect()->route('category.list');
    }

    public function delete($id = null)
    {
        $data = Category::findOrFail($id);
        $data->delete();
        return redirect()->route('category.list');
    }
}
