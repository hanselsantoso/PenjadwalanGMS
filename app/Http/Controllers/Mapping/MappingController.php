<?php

namespace App\Http\Controllers\Mapping;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserTag;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function index()
    {
        $mapping = UserTag::all();
        $user = User::where('status_user', 1)->where('role', 1)->get();
        $tags = Tag::where('status_tag', 1)->get();
        
        // dd($user);

        return view('mapping.index', compact('mapping', 'tags', 'user'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id_user' => 'required|integer',
            'id_tag' => 'required|integer',
        ]);

        $mapping = new UserTag();
        $mapping->id_user = $request->id_user;
        $mapping->id_tag = $request->id_tag;
        $mapping->save();
        // foreach ($id_tags as $id_tag) {
        //     $mapping = new UserTag();
        //     $mapping->id_user = $id_user;
        //     $mapping->id_tag = $id_tag;
        //     $mapping->save();
        // }

        return redirect()->route('mapping.index')->with('success', 'Mapping berhasil dibuat.');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // try {
            $request->validate([
                'id_user_tag' => 'required|integer',
                'id_user' => 'required|integer',
                'id_tag' => 'required|string|max:255',
            ]);

            $mapping = UserTag::find($request->id_user_tag);
            $mapping->id_user = $request->id_user;
            $mapping->id_tag = $request->id_tag;
            $mapping->save();

            return redirect()->route('mapping.index')->with('success', 'Mapping berhasil diperbarui.');
        // } catch (\Exception $e) {
        //     return redirect()->route('mapping.index')->with('error', 'Terjadi kesalahan saat memperbarui mapping.');
        // }
    }

    public function activate($id)
    {
        try {
            $mapping = UserTag::findOrFail($id);
            $mapping->status_user_tag = 1;
            $mapping->save();

            return redirect()->route('mapping.index')->with('success', 'Mapping berhasil diaktifkan.');
        } catch (\Exception $e) {
            return redirect()->route('mapping.index')->with('error', 'Terjadi kesalahan saat mengaktifkan mapping.');
        }
    }

    public function deactivate($id)
    {
        try {
            $mapping = UserTag::findOrFail($id);
            $mapping->status_user_tag = 0;
            $mapping->save();

            return redirect()->route('mapping.index')->with('success', 'Mapping berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->route('mapping.index')->with('error', 'Terjadi kesalahan saat menonaktifkan mapping.');
        }
    }
}
