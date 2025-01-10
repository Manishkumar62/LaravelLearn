<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\Category;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('bookmark.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        BookMark::create([
            'title' => $validatedData['title'],
            'url' => $validatedData['url'],
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('bookmark.list');
    }
    public function list($category = null)
    {
        $bookmarks = BookMark::paginate(5);

        if (request()->ajax()) {
            $bookmarks = BookMark::with(['category'])
            ->whereHas('category', function($query) use ($category) {
                $query->where('name', 'like', "%$category%");
            })
            ->paginate(5);
            return response()->json($bookmarks);
        }
        return view('bookmark.list', compact('bookmarks'));
    }

    public function edit($id = null)
    {
        $data = BookMark::findOrFail($id);
        $categories = Category::all();
        return view('bookmark.edit', compact('data', 'categories'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = BookMark::findOrFail($id);
        $data->update([
            'title' => $validatedData['title'],
            'url' => $validatedData['url'],
            'category_id' => $validatedData['category_id'],
        ]);
        return redirect()->route('bookmark.list');
    }

    public function delete($id = null)
    {
        $data = BookMark::findOrFail($id);
        $data->delete();
        return redirect()->route('bookmark.list');
    }
}
