@extends('admin.layout.master')
@section('title', 'Data Pemasukan | SISKEU')
@section('menuDataKeuangan', 'active')
@section('menuDataPengeluaran', 'active')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-6 col-md-12 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('admin/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                class="rounded" />
                        </div>
                    </div>
                    <span>Pemasukan</span>
                    <h3 class="card-title text-nowrap mb-1">
                        {{ $totPemasukan ? 'Rp. ' . number_format($totPemasukan, 0, ',', '.') . ',-' : 'Rp. 0,-' }}
                    </h3>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                        +{{ $lastPemasukan->jumlah ?? '0' }}%</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('admin/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                class="rounded" />
                        </div>
                    </div>
                    <span>Pengeluaran</span>
                    <h3 class="card-title text-nowrap mb-1">
                        {{ $totPengeluaran ? 'Rp. ' . number_format($totPengeluaran, 0, ',', '.') . ',-' : 'Rp. 0,-' }}
                    </h3>
                    <small class="text-danger fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                        +{{ $lastPengeluaran->jumlah ?? '0' }}%</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('data-pengeluaran.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i>
                        Tambahkan Data Pengeluaran
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 5%;text-align:center">No.</th>
                                <th style="text-align:center">Pengeluaran</th>
                                <th style="text-align:center">Tanggal</th>
                                <th style="text-align:center">Jumlah</th>
                                <th style="text-align:center">Keterangan</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluarans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->pengeluaran ?? '-' }}</td>
                                    <td>{{ $data->tgl_pengeluaran ?? '-' }}</td>
                                    <td>Rp. {{ $data->jumlah ?? '-' }}, -</td>
                                    <td>{{ $data->keterangan ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('data-pengeluaran.destroy', $data->id) }}" method="POST"
                                            class="d-flex flex-wrap">
                                            @csrf
                                            <a href="{{ route('data-pengeluaran.edit', $data->id) }}"
                                                class="btn btn-sm btn-outline-info mx-2">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" id="hapusData">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>
    <script>
        // Mendengarkan acara klik tombol hapus
        $(document).on('click', '#hapusData', function(event) {
            event.preventDefault(); // Mencegah perilaku default tombol

            // Ambil URL aksi penghapusan dari atribut 'action' formulir
            var deleteUrl = $(this).closest('form').attr('action');

            // Tampilkan SweetAlert saat tombol di klik
            Swal.fire({
                icon: 'question',
                title: 'Hapus Data Pengeluaran?',
                text: 'Apakah anda yakin untuk menghapus data ini?',
                showCancelButton: true, // Tampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan jika pengguna mengkonfirmasi penghapusan
                if (result.isConfirmed) {
                    // Kirim permintaan AJAX DELETE ke URL penghapusan
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}" // Kirim token CSRF untuk keamanan
                        },
                        success: function(response) {
                            // Tampilkan pesan sukses jika penghapusan berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Data successfully deleted.',
                                showConfirmButton: false,
                                timer: 1500 // Durasi pesan success (dalam milidetik)
                            });

                            // Refresh halaman setelah pesan sukses ditampilkan
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            // Tampilkan pesan error jika penghapusan gagal
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menghapus data.',
                                showConfirmButton: false,
                                timer: 1500 // Durasi pesan error (dalam milidetik)
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
