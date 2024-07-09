@extends('admin.layout.master')
@section('title', 'Data Pemasukan | SISKEU')
@section('menuDataKeuangan', 'active')
@section('menuDataPengeluaran', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-pengeluaran.update', $pengeluarans->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-pengeluaran.index') }}" class="btn btn-primary">
                            <i class="bx bx-left-arrow-alt"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bx bx-save"></i>
                            Simpan Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Pengeluaran</label>
                                    <input type="text" name="pengeluaran"
                                        class="form-control @error('pengeluaran') is-invalid @enderror"
                                        value="{{ old('pengeluaran', $pengeluarans->pengeluaran) }}"
                                        placeholder="Masukan nama pengeluaran">
                                    @error('pengeluaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Pengeluaran</label>
                                    <input type="date" name="tgl_pengeluaran"
                                        class="form-control @error('tgl_pengeluaran') is-invalid @enderror"
                                        value="{{ old('tgl_pengeluaran', $pengeluarans->tgl_pengeluaran) }}">
                                    @error('tgl_pengeluaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah Pemasukan</label>
                                    <input type="number" name="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror"
                                        value="{{ old('jumlah', $pengeluarans->jumlah ?? '-') }}"
                                        placeholder="Masukan jumlah pemasukan">
                                    @error('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="5"
                                        placeholder="Masukan keterangan">{{ old('keterangan', $pengeluarans->keterangan ?? '-') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
