<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bendahara;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBendaharaController extends Controller
{
    public function index()
    {
        $bendaharas = Bendahara::latest()->get();
        return view('admin.bendahara.index', [
            'bendaharas' => $bendaharas,
        ]);
    }

    public function create()
    {
        return view('admin.bendahara.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:wargas,nik',
            'nama' => 'required',
            'jk' => 'required',
            'telp' => 'required',
        ], [
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah tersedia',
            'nama.required' => 'Nama wajib diisi',
            'jk.required' => 'Jenis Kelamin wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
        ]);

        $bendaharas = Bendahara::create($validated);

        User::create([
            'name' => $request->nama ?? '-',
            'username' => $request->nik ?? '-',
            'password' => bcrypt('12345678'),
            'level_id' => '2',
            'telp' => $request->telp ?? '-',
            'bendahara_id' => $bendaharas->id,
        ]);

        return redirect('data-bendahara')->with('success', 'Selamat! Anda berhasil menambahkan data!');
    }

    public function edit($id)
    {
        $bendaharas = Bendahara::where('id', $id)->first();
        return view('admin.bendahara.edit', [
            'bendaharas' => $bendaharas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jk' => 'required',
            'telp' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'jk.required' => 'Jenis Kelamin wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
        ]);

        Bendahara::where('id', $id)->update($validated);

        return redirect('data-bendahara')->with('success', 'Selamat! Anda berhasil memperbaharui data!');
    }

    public function destroy($id)
    {
        $users = User::where('bendahara_id', $id)->first();
        $users->delete();
        $bendaharas = Bendahara::where('id', $id)->first();
        $bendaharas->delete();

        return redirect('data-bendahara')->with('success', 'Selamat! Anda berhasil menghapus data!');
    }
}
