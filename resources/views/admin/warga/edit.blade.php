@extends('admin.layout.master')
@section('title', 'Data Warga | SISKEU')
@section('menuDataMaster', 'active')
@section('menuDataWarga', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-warga.update', $wargas->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-warga.index') }}" class="btn btn-primary">
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
                                    <label>NIK</label>
                                    <input type="text" name="nik"
                                        class="form-control @error('nik') is-invalid @enderror"
                                        value="{{ old('nik', $wargas->nik) }}" placeholder="Masukan NIK" readonly>
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $wargas->nama ?? '-') }}" placeholder="Masukan nama lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" class="form-control @error('jk') is-invalid @enderror"
                                        id="selectedJk">
                                        <option value="" selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki" {{ $wargas->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                            Laki-Laki
                                        </option>
                                        <option value="Perempuan" {{ $wargas->jk == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                    @error('jk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Status Perkawinan</label>
                                    <select name="status_perkawinan"
                                        class="form-control @error('status_perkawinan') is-invalid @enderror"
                                        id="selectedStatusPerkawinan">
                                        <option value="" selected>Pilih Status Perkawinan</option>
                                        <option value="Belum Menikah"
                                            {{ $wargas->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum
                                            Menikah
                                        </option>
                                        <option value="Menikah"
                                            {{ $wargas->status_perkawinan == 'Menikah' ? 'selected' : '' }}>
                                            Menikah
                                        </option>
                                        <option value="Cerai"
                                            {{ $wargas->status_perkawinan == 'Cerai' ? 'selected' : '' }}>
                                            Cerai
                                        </option>
                                    </select>
                                    @error('status_perkawinan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Nomor Telepon</label>
                                    <input type="number" name="telp"
                                        class="form-control @error('telp') is-invalid @enderror"
                                        value="{{ old('telp', $wargas->telp) }}" placeholder="Masukan nomor telepon">
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Tanggal Pembayaran</label>
                                    <input type="date" name="tgl_bayar"
                                        class="form-control @error('tgl_bayar') is-invalid @enderror"
                                        value="{{ old('tgl_bayar', $wargas->tgl_bayar) }}">
                                    @error('tgl_bayar')
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
@push('custom-script')
    <script>
        $(document).ready(function() {
            $('#selectedJk').select2({
                theme: 'bootstrap4',
            });
        });
        $(document).ready(function() {
            $('#selectedStatusPerkawinan').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
