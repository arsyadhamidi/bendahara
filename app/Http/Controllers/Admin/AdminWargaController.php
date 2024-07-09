<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;

class AdminWargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::latest()->get();
        return view('admin.warga.index', [
            'wargas' => $wargas,
        ]);
    }

    public function create()
    {
        return view('admin.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:wargas,nik',
            'nama' => 'required',
            'jk' => 'required',
            'status_perkawinan' => 'required',
            'telp' => 'required',
            'tgl_bayar' => 'required',
        ], [
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah tersedia',
            'nama.required' => 'Nama wajib diisi',
            'jk.required' => 'Jenis Kelamin wajib diisi',
            'status_perkawinan.required' => 'Status Perkawinan wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'tgl_bayar.required' => 'Tanggal Pembayaran wajib diisi',
        ]);

        $wargas = Warga::create($validated);

        User::create([
            'name' => $request->nama ?? '-',
            'username' => $request->nik ?? '-',
            'password' => bcrypt('12345678'),
            'level_id' => '3',
            'telp' => $request->telp ?? '-',
            'warga_id' => $wargas->id,
        ]);

        return redirect('data-warga')->with('success', 'Selamat! Anda berhasil menambahkan data!');
    }

    public function edit($id)
    {
        $wargas = Warga::where('id', $id)->first();
        return view('admin.warga.edit', [
            'wargas' => $wargas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jk' => 'required',
            'status_perkawinan' => 'required',
            'telp' => 'required',
            'tgl_bayar' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'jk.required' => 'Jenis Kelamin wajib diisi',
            'status_perkawinan.required' => 'Status Perkawinan wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'tgl_bayar.required' => 'Tanggal Pembayaran wajib diisi',
        ]);

        Warga::where('id', $id)->update($validated);

        return redirect('data-warga')->with('success', 'Selamat! Anda berhasil memperbaharui data!');
    }

    public function destroy($id)
    {
        $users = User::where('warga_id', $id)->first();
        $users->delete();
        $wargas = Warga::where('id', $id)->first();
        $wargas->delete();

        return redirect('data-warga')->with('success', 'Selamat! Anda berhasil menghapus data!');
    }
}
