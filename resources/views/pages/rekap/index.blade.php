@extends('layouts.main')

@section('title', 'Rekap Transaksi')
@section('subtitle', 'Data Rekap Transaksi')

@section('content')
    <main class="container">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-6">
                                <p>
                                    Pendapatan : Rp {{ number_format($pendapatan, 2, ',', '.') }}
                                </p>
                                <p class="mt-4">
                                    Pemasukan : Rp {{ number_format($totalPemasukan, 2, ',', '.') }}
                                </p>
                                <p class="mt-4">
                                    Pengeluaran : Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="pb-2 mt-3">
                                    @if (Auth::user()->id_role == 2)
                                        <form action="{{ route('rekap.export') }}" method="GET" class="form-control">
                                            <span class="d-flex -mb-4">
                                                <h5>Pilih Rentang Waktu :</h5>
                                            </span>
                                            @csrf
                                            <div class="col d-flex justify-content-start align-items-center">
                                                <input type="date" name="start_date" class="form-control h-50 me-2 mb-2"
                                                    required>
                                                <input type="date" name="end_date" class="form-control h-50 me-2 mb-2"
                                                    required>
                                                <button type="submit" class="btn btn-secondary">Cetak</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ route('pegawai.rekap.export') }}" method="GET"
                                            class="form-control">
                                            <span class="d-flex -mb-4">
                                                <h5>Pilih Rentang Waktu :</h5>
                                            </span>
                                            @csrf
                                            <div class="col d-flex justify-content-start align-items-center">
                                                <input type="date" name="start_date" class="form-control h-50 me-2 mb-2"
                                                    required>
                                                <input type="date" name="end_date" class="form-control h-50 me-2 mb-2"
                                                    required>
                                                <button type="submit" class="btn btn-secondary">Cetak</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive p-0">
                <table class="table table-hover table-bordered align-items-center" id="myTable">
                    <thead style="font-size: 10pt">
                        <tr style="background-color: rgb(187, 246, 201)">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Pengguna</th>
                            <th class="text-center">Anggota</th>
                            <th class="text-center">Jenis Transaksi</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah Masuk</th>
                            <th class="text-center">Jumlah Keluar</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="font-size: 10pt">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @if (Auth::user()->id_role == 2)
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ route('rekap') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_pengguna',
                            name: 'nama_pengguna'
                        },
                        {
                            data: 'anggota',
                            name: 'anggota'
                        },
                        {
                            data: 'jenis_transaksi',
                            name: 'jenis_transaksi'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $('.datatable-input').on('input', function() {
                    var searchText = $(this).val().toLowerCase();

                    $('.table tr').each(function() {
                        var rowData = $(this).text().toLowerCase();
                        if (rowData.indexOf(searchText) === -1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ route('pegawai.rekap') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_pengguna',
                            name: 'nama_pengguna'
                        },
                        {
                            data: 'anggota',
                            name: 'anggota'
                        },
                        {
                            data: 'jenis_transaksi',
                            name: 'jenis_transaksi'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $('.datatable-input').on('input', function() {
                    var searchText = $(this).val().toLowerCase();

                    $('.table tr').each(function() {
                        var rowData = $(this).text().toLowerCase();
                        if (rowData.indexOf(searchText) === -1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                });
            });
        </script>
    @endif
@endsection
