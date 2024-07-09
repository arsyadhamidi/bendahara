<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use App\Models\Warga;

class WargaIuranController extends Controller
{
    public function index()
    {
        $iurans = Iuran::where('warga_id', Auth()->user()->warga_id)
            ->latest()
            ->get();
        $wargas = Warga::where('id', Auth()->user()->warga_id)->first();

        return view('warga.iuran.index', [
            'iurans' => $iurans,
            'wargas' => $wargas,
        ]);
    }

}
