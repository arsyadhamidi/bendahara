<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class AdminPemasukanController extends Controller
{
    public function index()
    {
        $pemasukans = Pemasukan::latest()->get();
        $totPemasukan = Pemasukan::sum('jumlah');
        $lastPemasukan = Pemasukan::latest()->first();

        $totPengeluaran = Pengeluaran::sum('jumlah');
        $lastPengeluaran = Pengeluaran::latest()->first();

        return view('admin.pemasukan.index', [
            'pemasukans' => $pemasukans,
            'totPemasukan' => $totPemasukan,
            'lastPemasukan' => $lastPemasukan,
            'totPengeluaran' => $totPengeluaran,
            'lastPengeluaran' => $lastPengeluaran,
        ]);
    }

    public function create()
    {
        return view('admin.pemasukan.create');
    }

    public function store(Request $request)
    {
        $valdiated = $request->validate([
            'masukan' => 'required',
            'tgl_masukan' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ], [
            'masukan.required' => 'Pemasukan wajib diisi',
            'tgl_masukan.required' => 'Tanggal Pemasukan wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
        ]);

        Pemasukan::create($valdiated);

        return redirect('/data-pemasukan')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $permasukans = Pemasukan::find($id);
        return view('admin.pemasukan.edit', [
            'pemasukans' => $permasukans,
        ]);
    }

    public function update(Request $request, $id)
    {
        $valdiated = $request->validate([
            'masukan' => 'required',
            'tgl_masukan' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ], [
            'masukan.required' => 'Pemasukan wajib diisi',
            'tgl_masukan.required' => 'Tanggal Pemasukan wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
        ]);

        Pemasukan::where('id', $id)->update($valdiated);

        return redirect('/data-pemasukan')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $pemasukans = Pemasukan::find($id);
        $pemasukans->delete();
        return redirect('/data-pemasukan')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}
