<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function create()
    {
        return view('bookmark.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'url' => 'required|url',
            'category' => 'required|string|max:20',
        ]);

        BookMark::create([
            'title' => $validatedData['title'],
            'url' => $validatedData['url'],
            'category' => $validatedData['category'],
        ]);

        return redirect()->route('bookmark.list');
    }
    public function list($category = null)
    {
        $bookmarks = BookMark::paginate(5);
        // if ($category != null) {

            if (request()->ajax()) {
                $bookmarks = Bookmark::when($category, function($query) use($category){
                    $query->where('category', 'like', "%$category%");
                })->paginate(5);
                return response()->json($bookmarks);
            }
        // }
        return view('bookmark.list', compact('bookmarks'));
    }

    public function edit($id = null)
    {
        $data = BookMark::findOrFail($id);
        return view('bookmark.edit', compact('data'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'url' => 'required|url',
            'category' => 'required|string|max:20',
        ]);
        $id = $request->id;
        $data = BookMark::findOrFail($id);
        $data->update([
            'title' => $validatedData['title'],
            'url' => $validatedData['url'],
            'category' => $validatedData['category'],
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
