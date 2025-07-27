<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserTag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request) {
        $user = User::where('role', '!=', 0)
            ->with(['tim_pelayanan_d.tim_pelayanan_h'])
            ->get()
            ->map(function($user) {
                if (isset($user->tim_pelayanan_d)) {
                    $user->team_name = $user->tim_pelayanan_d->tim_pelayanan_h->nama_tim_pelayanan_h;
                } else {
                    $user->team_name = '-';
                }
                return $user;
            })
            ->groupBy('team_name')
            ->flatten();

        $tag = Tag::where('status_tag',1)->get();
        return view('Admin.user_management',with([
            'user' => $user,
            'tag' => $tag,
        ]));
    }

    // public function detailUser(Request $request, $id){
    //     $user = User::find($id);
    //     $info = $user->getInfo();
    //     // dd($info);
    //     return view('Admin.detailUser',with([
    //         'user'=> $user,
    //         'info'=> $info,
    //     ]));
    // }

    public function store(Request $request)
    {
        $this->doValidate($request, 'CREATE');
        try {
            $id_tags = $request->id_tag;
            // Create a new User with role 1
            $user = new User();
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->nij = $request->input('nij');
            $user->alamat = $request->input('alamat');
            $user->kesibukan = $request->input('kesibukan');
            $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempat_lahir');
            $user->tanggal_lahir = Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->format('Y-m-d');
            dump($user->tanggal_lahir);
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
            
            if (isset($id_tags)) {
                foreach ($id_tags as $id_tag) {
                    $mapping = new UserTag();
                    $mapping->id_user = $user->id;
                    $mapping->id_tag = $id_tag;
                    $mapping->save();
                }
            }

            return redirect()->back()->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan user.');
        }
    }

    public function update(Request $request)
    {
        $this->doValidate($request, 'UPDATE');
        // dd($request->all());
        // Update user data
        try {
            $user = User::find($request->input('idUser'));
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->nij = $request->input('nij');
            $user->alamat = $request->input('alamat');
            $user->kesibukan = $request->input('kesibukan');
            $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempat_lahir');
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

    private function doValidate(Request $request, String $type) {
        $request->validate([
            'email' => $type == 'UPDATE' ? 'required' : 'required|unique:users,email',
            'nij' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255', 
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|boolean',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date_format:d-m-Y',
            'telp' => 'required|string|max:50',
            'kesibukan' => 'required|string|in:Bekerja,Kuliah,Lainnya',
            'nomor_cg' => 'required|string|max:10',
            'posisi_cg' => 'required|string|in:Anggota,Pemimpin', 
            'nama_pemimpin' => 'required|string|max:255',
            'telp_pemimpin' => 'required|string|max:50',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'nij.required' => 'NIJ wajib diisi', 
            'nij.max' => 'NIJ maksimal 255 karakter',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'jenis_kelamin.boolean' => 'Jenis kelamin tidak valid',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter', 
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date_format' => 'Format tanggal lahir tidak valid (dd-mm-yyyy)',
            'telp.required' => 'No telepon wajib diisi',
            'telp.max' => 'No telepon maksimal 50 karakter',
            'kesibukan.required' => 'Kesibukan wajib diisi',
            'kesibukan.in' => 'Kesibukan tidak valid',
            'nomor_cg.required' => 'Nomor CG wajib diisi',
            'nomor_cg.numeric' => 'Nomor CG harus berupa angka',
            'nomor_cg.max' => 'Nomor CG maksimal 50',
            'posisi_cg.required' => 'Posisi CG wajib diisi',
            'posisi_cg.in' => 'Posisi CG tidak valid',
            'nama_pemimpin.required' => 'Nama pemimpin wajib diisi',
            'nama_pemimpin.max' => 'Nama pemimpin maksimal 255 karakter',
            'telp_pemimpin.required' => 'No telepon pemimpin wajib diisi',
            'telp_pemimpin.max' => 'No telepon pemimpin maksimal 50 karakter'
        ]);
    }

    public function activate(Request $request, $id)
    {
        $user = User::find($id);
        $user->status_user = 1;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil di-aktifkan.');
    }

    public function deactivate(Request $request, $id)
    {
        $user = User::find($id);
        $user->status_user = 0;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil di-suspend.');
    }

    public function excelStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data user berhasil diimport.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'There was an error during the import: ' . $e->getMessage());
        }
    }
}
