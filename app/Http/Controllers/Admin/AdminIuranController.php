<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;

class AdminIuranController extends Controller
{
    public function index()
    {
        $iurans = Iuran::latest()->get();
        return view('admin.iuran.index', [
            'iurans' => $iurans,
        ]);
    }

    public function create()
    {
        $wargas = Warga::latest()->get();
        return view('admin.iuran.create', [
            'wargas' => $wargas,
        ]);
    }

    public function store(Request $request)
    {
        $valdiated = $request->validate([
            'warga_id' => 'required',
            'nama_iuran' => 'required',
            'jenis_iuran' => 'required',
            'tgl_bayar' => 'required',
            'jumlah' => 'required',
        ], [
            'warga_id.required' => 'Warga wajib diisi',
            'nama_iuran.required' => 'Nama Iuran wajib diisi',
            'jenis_iuran.required' => 'Jenis Iuran wajib diisi',
            'tgl_bayar.required' => 'Tanggal Bayar wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
        ]);

        Iuran::create($valdiated);

        return redirect('/data-iuran')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $iurans = Iuran::find($id);
        $wargas = Warga::latest()->get();
        return view('admin.iuran.edit', [
            'iurans' => $iurans,
            'wargas' => $wargas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $valdiated = $request->validate([
            'warga_id' => 'required',
            'nama_iuran' => 'required',
            'jenis_iuran' => 'required',
            'tgl_bayar' => 'required',
            'jumlah' => 'required',
        ], [
            'warga_id.required' => 'Warga wajib diisi',
            'nama_iuran.required' => 'Nama Iuran wajib diisi',
            'jenis_iuran.required' => 'Jenis Iuran wajib diisi',
            'tgl_bayar.required' => 'Tanggal Bayar wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
        ]);

        Iuran::where('id', $id)->update($valdiated);

        return redirect('/data-iuran')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $levels = Iuran::find($id);
        $levels->delete();
        return redirect('/data-iuran')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}
