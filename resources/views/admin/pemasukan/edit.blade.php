@extends('admin.layout.master')
@section('title', 'Data Pemasukan | SISKEU')
@section('menuDataKeuangan', 'active')
@section('menuDataPemasukan', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-pemasukan.update', $pemasukans->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-pemasukan.index') }}" class="btn btn-primary">
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
                                    <label>Pemasukan</label>
                                    <input type="text" name="masukan"
                                        class="form-control @error('masukan') is-invalid @enderror"
                                        value="{{ old('masukan', $pemasukans->masukan) }}"
                                        placeholder="Masukan nama pemasukan">
                                    @error('masukan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Pemasukan</label>
                                    <input type="date" name="tgl_masukan"
                                        class="form-control @error('tgl_masukan') is-invalid @enderror"
                                        value="{{ old('tgl_masukan', $pemasukans->tgl_masukan) }}">
                                    @error('tgl_masukan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah Pemasukan</label>
                                    <input type="number" name="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror"
                                        value="{{ old('jumlah', $pemasukans->jumlah ?? '-') }}"
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
                                        placeholder="Masukan keterangan">{{ old('keterangan', $pemasukans->keterangan ?? '-') }}</textarea>
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
