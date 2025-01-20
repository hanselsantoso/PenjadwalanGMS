<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User as ModelsUser;
use App\Models\UserTag;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function mapping()
    {
        $mapping = UserTag::where('status_user_tag', 1)->get();
        $user = ModelsUser::where('status_user', 1)->where('role', 1)->get();
        $tags = Tag::where('status_tag', 1)->get();

        return view('mapping', compact('mapping', 'tags', 'user'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user' => 'required|integer',
            'tags' => 'required|integer',
        ]);

        $id_user = $request->user;
        $id_tags = $request->tags;

        $mapping = new UserTag();
        $mapping->id_user = $id_user;
        $mapping->id_tag = $id_tags;
        $mapping->save();
        // foreach ($id_tags as $id_tag) {
        //     $mapping = new UserTag();
        //     $mapping->id_user = $id_user;
        //     $mapping->id_tag = $id_tag;
        //     $mapping->save();
        // }

        return redirect()->route('mapping_index')->with('success', 'Mapping berhasil dibuat.');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // try {
            $request->validate([
                'id_user_tag' => 'required|integer',
                'user' => 'required|integer',
                'tags' => 'required|string|max:255',
            ]);

            $mapping = UserTag::find($request->id_user_tag);
            $mapping->id_user = $request->user;
            $mapping->id_tag = $request->tags;
            $mapping->save();
            return redirect()->route('mapping_index')->with('success', 'Mapping berhasil diperbarui.');
        // } catch (\Exception $e) {
        //     return redirect()->route('mapping_index')->with('error', 'Terjadi kesalahan saat memperbarui mapping.');
        // }
    }

    public function deactivate($id)
    {
        try {
            $mapping = UserTag::findOrFail($id);
            $mapping->status_user_tag = 0;
            $mapping->save();

            return redirect()->route('mapping_index')->with('success', 'Mapping berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->route('mapping_index')->with('error', 'Terjadi kesalahan saat menonaktifkan mapping.');
        }
    }

    public function activate($id)
    {
        try {
            $mapping = UserTag::findOrFail($id);
            $mapping->status_user_tag = 1;
            $mapping->save();

            return redirect()->route('mapping_index')->with('success', 'Mapping berhasil diaktifkan.');
        } catch (\Exception $e) {
            return redirect()->route('mapping_index')->with('error', 'Terjadi kesalahan saat mengaktifkan mapping.');
        }
    }





}
