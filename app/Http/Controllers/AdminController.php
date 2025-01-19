<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Aturan;
use App\Models\simpanan;
use App\Models\Simpanan_H;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserTag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $user = User::where('role', '!=', 0)->get();

        $tag = Tag::where('status_tag',1)->get();
        return view('Admin.dashboard',with([
            'user' => $user,
            'tag' => $tag,
    ]));
    }

    public function detailUser(Request $request, $id){
        $user = User::find($id);
        $info = $user->getInfo();
        // dd($info);
        return view('Admin.detailUser',with([
            'user'=> $user,
            'info'=> $info,
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'unique:users,email',
        ]);
        try {
            $id_tags = $request->id_tag;
            // Create a new User with role 1
            $user = new User();
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->nij = $request->input('nij');
            $user->alamat = $request->input('alamat');
            $user->kesibukan = $request->input('kesibukan');
            $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempatLahir');
            $user->tanggal_lahir =  Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->format('Y-m-d');
            $user->jenis_kelamin = $request->input('jenis_kelamin');
            $user->telp = $request->input('telp');
            $user->nomor_cg = $request->input('nomor_cg');
            $user->posisi_cg = $request->input('posisi_cg');
            $user->nama_pemimpin = $request->input('nama_pemimpin');
            $user->telp_pemimpin = $request->input('telp_pemimpin');
            $user->password = bcrypt('abcde12345');
            $user->status_user = 1;
            $user->role = 1; //percobaan
            $user->save();

            foreach ($id_tags as $id_tag) {
                $mapping = new UserTag();
                $mapping->id_user = $user->id;
                $mapping->id_tag = $id_tag;
                $mapping->save();
            }

            return redirect()->back()->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan user.');
        }
    }

    public function excel_store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));

            return redirect()->back()->with('success', 'Users have been successfully imported.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'There was an error during the import: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // Update user data
        try {
            $user = User::find($request->input('idUser'));
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->nij = $request->input('nij');
            $user->alamat = $request->input('alamat');
            $user->kesibukan = $request->input('kesibukan');
            $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempatLahir');
            $user->tanggal_lahir =  Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->format('Y-m-d');
            $user->jenis_kelamin = $request->input('jenis_kelamin');
            $user->telp = $request->input('telp');
            $user->nomor_cg = $request->input('nomor_cg');
            $user->posisi_cg = $request->input('posisi_cg');
            $user->nama_pemimpin = $request->input('nama_pemimpin');
            $user->telp_pemimpin = $request->input('telp_pemimpin');

            $user->save();

            return redirect()->back()->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui user.');
        }
    }

    public function deactivate(Request $request, $id)
    {
        // Suspend user
        $user = User::find($id);
        $user->status_user = 0;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil di-suspend.');
    }

    public function activate(Request $request, $id)
    {
        // Activate user
        $user = User::find($id);
        $user->status_user = 1;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil di-aktifkan.');
    }
}
