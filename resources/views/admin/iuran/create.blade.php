@extends('admin.layout.master')
@section('title', 'Data Iuran | SISKEU')
@section('menuDataKeuangan', 'active')
@section('menuDataIuran', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-iuran.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-iuran.index') }}" class="btn btn-primary">
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
                                    <label>Warga</label>
                                    <select name="warga_id" class="form-control @error('warga_id') is-invalid @enderror"
                                        id="selectedWarga">
                                        <option value="" selected>Pilih Warga</option>
                                        @foreach ($wargas as $data)
                                            <option value="{{ $data->id }}" {{ old('warga_id') == $data->id }}>
                                                {{ $data->nama ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                    @error('warga_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Nama Iuran</label>
                                    <input type="text" name="nama_iuran"
                                        class="form-control @error('nama_iuran') is-invalid @enderror"
                                        value="{{ old('nama_iuran') }}" placeholder="Masukan nama iuran">
                                    @error('nama_iuran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Jenis Iuran</label>
                                    <input type="text" name="jenis_iuran"
                                        class="form-control @error('jenis_iuran') is-invalid @enderror"
                                        value="{{ old('jenis_iuran') }}" placeholder="Masukan jenis iuran">
                                    @error('jenis_iuran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Bayar</label>
                                    <input type="date" name="tgl_bayar"
                                        class="form-control @error('tgl_bayar') is-invalid @enderror"
                                        value="{{ old('tgl_bayar', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                    @error('tgl_bayar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah Pembayaran</label>
                                    <input type="number" name="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror"
                                        value="{{ old('jumlah') }}" placeholder="Masukan jumlah bayar">
                                    @error('jumlah')
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
            $('#selectedWarga').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
