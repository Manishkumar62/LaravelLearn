<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function create(){
        return view('bookmark.create');
    }

    public function store(Request $request){
        BookMark::create([
            'title' => $request->title,
            'url' => $request->url,
            'category' => $request->category,

        ]);
        return redirect()->route('bookmark.list');

    }
    public function list(){
        $bookmarks = BookMark::all();
        return view('bookmark.list', compact('bookmarks'));
    }

    public function search(Request $request){
        $bookmarks = BookMark::where('category','like','%'.$request->search.'%')->get();
        return view('bookmark.list', compact('bookmarks'));

    }

    public function edit($id = null){
        $data = BookMark::findOrFail($id);
        return view('bookmark.edit', compact('data'));
    }
    public function update(Request $request){
        $id = $request->id;
        $data = BookMark::findOrFail($id);
        $data->update([
            'title' => $request->title,
            'url' => $request->url,
            'category' => $request->category,
            ]);
        return redirect()->route('bookmark.list');
    }

    public function delete($id=null){
        $data = BookMark::findOrFail($id);
        $data->delete();
        return redirect()->route('bookmark.list');
    }
}
