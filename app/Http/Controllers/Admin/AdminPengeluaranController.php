<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class AdminPengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::latest()->get();
        $totPemasukan = Pemasukan::sum('jumlah');
        $lastPemasukan = Pemasukan::latest()->first();
        $totPengeluaran = Pengeluaran::sum('jumlah');
        $lastPengeluaran = Pengeluaran::latest()->first();
        return view('admin.pengeluaran.index', [
            'pengeluarans' => $pengeluarans,
            'totPengeluaran' => $totPengeluaran,
            'lastPengeluaran' => $lastPengeluaran,
            'totPemasukan' => $totPemasukan,
            'lastPemasukan' => $lastPemasukan,
        ]);
    }

    public function create()
    {
        return view('admin.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $valdiated = $request->validate([
            'pengeluaran' => 'required',
            'tgl_pengeluaran' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ], [
            'pengeluaran.required' => 'Pemasukan wajib diisi',
            'tgl_pengeluaran.required' => 'Tanggal Pemasukan wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
        ]);

        Pengeluaran::create($valdiated);

        return redirect('/data-pengeluaran')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $pengeluarans = Pengeluaran::find($id);
        return view('admin.pengeluaran.edit', [
            'pengeluarans' => $pengeluarans,
        ]);
    }

    public function update(Request $request, $id)
    {
        $valdiated = $request->validate([
            'pengeluaran' => 'required',
            'tgl_pengeluaran' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ], [
            'pengeluaran.required' => 'Pemasukan wajib diisi',
            'tgl_pengeluaran.required' => 'Tanggal Pemasukan wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
        ]);

        Pengeluaran::where('id', $id)->update($valdiated);

        return redirect('/data-pengeluaran')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $pengeluarans = Pengeluaran::find($id);
        $pengeluarans->delete();
        return redirect('/data-pengeluaran')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}
