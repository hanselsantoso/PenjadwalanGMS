<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tag = Tag::all();
        return view('tag', compact('tag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:255',
        ]);

        $tag = new Tag();
        $tag->nama_tag = $request->nama_tag;
        $tag->status_tag = 1;
        $tag->save();
        return redirect()->route('tag.index')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_tag' => 'required|integer',
            'nama_tag' => 'required|string|max:255',
        ]);

        $tag = Tag::findOrFail($request->id_tag);
        $tag->nama_tag = $request->nama_tag;
        $tag->save();

        return redirect()->route('tag.index')->with('success', 'Tag berhasil diperbarui.');
    }

    public function activate($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->status_tag = true;
        $tag->save();

        return redirect()->route('tag.index')->with('success', 'Tag berhasil diaktifkan.');
    }

    public function deactivate($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->status_tag = false;
        $tag->save();

        return redirect()->route('tag.index')->with('success', 'Tag berhasil dinonaktifkan.');
    }
}
