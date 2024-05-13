@extends('layouts.main')

@section('title', 'Dashboard')
@section('subtitle', 'Dashboard')

@section('content')
    <main class="container">
        <div class="layout-wrapper layout-content-navbar">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                            <div class="card border border-0">
                                <div
                                    class="card-header border border-0 bg-light d-flex align-items-center justify-content-between pb-0">
                                    <h5 class="-mt-2">Pegawai</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex flex-column align-items-start gap-1">
                                            <h2 class="mb-2">{{ $jumlahPegawai }}</h2>
                                            <span>Jumlah Pegawai</span>
                                        </div>
                                        <div id="orderStatisticsChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                            <div class="card border border-0">
                                <div
                                    class="card-header border border-0 bg-light d-flex align-items-center justify-content-between pb-0">
                                    <h5 class="-mt-2">Anggota</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex flex-column align-items-start gap-1">
                                            <h2 class="mb-2">{{ $jumlahAnggota }}</h2>
                                            <span>Jumlah Anggota</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                            <div class="card border border-0">
                                <div
                                    class="card-header border border-0 d-flex align-items-center justify-content-between pb-0">
                                    <h5 class="-mt-2">Simpanan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex flex-column align-items-start gap-1">
                                            <h2 class="mb-2">{{ $jumlahSimpanan }}</h2>
                                            <span>Jumlah Simpanan</span>
                                        </div>
                                        <div id="orderStatisticsChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                            <div class="card border border-0">
                                <div
                                    class="card-header border border-0 d-flex align-items-center justify-content-between pb-0">
                                    <h5 class="-mt-2">Pinjaman</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex flex-column align-items-start gap-1">
                                            <h2 class="mb-2">{{ $jumlahSimpanan }}</h2>
                                            <span>Jumlah Pinjaman</span>
                                        </div>
                                        <div id="orderStatisticsChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->id_role != 1)
                            <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                                <div class="card border border-0">
                                    <div
                                        class="card-header border border-0 d-flex align-items-center justify-content-between pb-0">
                                        <h5 class="-mt-2">Saldo Simpanan Pokok</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-start gap-1">
                                                <h2 class="mb-2">Rp {{ number_format($saldoSimpananPokok, 2, ',', '.') }}
                                                </h2>
                                                <span>Total Saldo Simpanan Pokok</span>
                                            </div>
                                            <div id="orderStatisticsChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                                <div class="card border border-0">
                                    <div
                                        class="card-header border border-0 d-flex align-items-center justify-content-between pb-0">
                                        <h5 class="-mt-2">Saldo Simpanan Wajib</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-start gap-1">
                                                <h2 class="mb-2">Rp {{ number_format($saldoSimpananWajib, 2, ',', '.') }}
                                                </h2>
                                                <span>Total Saldo Simpanan Wajib</span>
                                            </div>
                                            <div id="orderStatisticsChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                                <div class="card border border-0">
                                    <div
                                        class="card-header border border-0 d-flex align-items-center justify-content-between pb-0">
                                        <h5 class="-mt-2">Saldo Simpanan Sukarela</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-start gap-1">
                                                <h2 class="mb-2">Rp
                                                    {{ number_format($saldoSimpananSukarela, 2, ',', '.') }}
                                                </h2>
                                                <span>Total Saldo Simpanan Sukarela</span>
                                            </div>
                                            <div id="orderStatisticsChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                                <div class="card border border-0">
                                    <div
                                        class="card-header border border-0 d-flex align-items-center justify-content-between pb-0">
                                        <h5 class="-mt-2">Saldo Kas Koperasi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-start gap-1">
                                                <h2 class="mb-2">Rp {{ number_format($pendapatan, 2, ',', '.') }}</h2>
                                                <span>Total Saldo Kas Koperasi</span>
                                            </div>
                                            <div id="orderStatisticsChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        @if (Auth::user()->id_role == 1)
                            <div class="col-md-6 mb-lg-0 my-4">
                                <div class="card border border-0 z-index-2 p-4 h-100">
                                    {!! $anggotaChart->container() !!}
                                </div>
                            </div>
                            <div class="col-md-6 mb-lg-0 my-4">
                                <div class="card border border-0 z-index-2 p-4 h-100">
                                    {!! $jenisAnggotaChart->container() !!}
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 mb-lg-0 my-4">
                                <div class="card border border-0 z-index-2 p-4 h-100">
                                    {!! $shuChart->container() !!}
                                </div>
                            </div>
                            <div class="col-md-6 mb-lg-0 my-4">
                                <div class="card border border-0 z-index-2 p-4 h-100">
                                    {!! $transaksiChart->container() !!}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4 my-4">
                            <div class="card border border-0 p-4">
                                <div
                                    class="card-header bg-white border border-0 d-flex align-items-center justify-content-start pb-0 m-0">
                                    <h5 class="text-start">Pinjaman Jatuh Tempo</h5>
                                </div>
                                <div class="table-responsive p-0">
                                    <table class="table table-hover table-bordered align-items-center" id="myTable">
                                        <thead style="font-size: 10pt">
                                            <tr style="background-color: rgb(187, 246, 201)">
                                                <th class="text-center w-8">Angsuran Ke-</th>
                                                <th class="text-center">Nama Anggota</th>
                                                <th class="text-center">Tanggal Jatuh Tempo</th>
                                                <th class="text-center">Angsuran Pokok</th>
                                                <th class="text-center">Bunga 1%</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center" style="font-size: 10pt">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if (Auth::user()->id_role == 1)
        <script src="{{ $anggotaChart->cdn() }}"></script>
        <script src="{{ $jenisAnggotaChart->cdn() }}"></script>

        {{ $anggotaChart->script() }}
        {{ $jenisAnggotaChart->script() }}
    @else
        @if (Auth::user()->id_role == 2)
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: "{{ route('dashboard') }}",
                        columns: [{
                                data: 'angsuran_ke_',
                                name: 'angsuran_ke_'
                            },
                            {
                                data: 'nama_anggota',
                                name: 'nama_anggota'
                            },
                            {
                                data: 'tanggal_jatuh_tempo',
                                name: 'tanggal_jatuh_tempo'
                            },
                            {
                                data: 'angsuran_pokok',
                                name: 'angsuran_pokok',
                                render: function(data) {
                                    return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }) : '-';
                                }
                            },
                            {
                                data: 'bunga',
                                name: 'bunga',
                                render: function(data) {
                                    return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }) : '-';
                                }
                            },
                            {
                                data: 'status_pelunasan',
                                name: 'status_pelunasan'
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return '<div class="row justify-content-center">' +
                                        '<div class="col-auto">' +
                                        '<a href="{{ route('pinjaman.show', '') }}/' + data.id_pinjaman +
                                        '" style="font-size: 10pt" class="btn btn-secondary m-1 edit-btn" ' +
                                        'data-id="' + data.id +
                                        '">Lihat</a>' +
                                        '</div>' +
                                        '</div>';
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
        @elseif (Auth::user()->id_role == 3)
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: "{{ route('pegawai.dashboard') }}",
                        columns: [{
                                data: 'angsuran_ke_',
                                name: 'angsuran_ke_'
                            },
                            {
                                data: 'nama_anggota',
                                name: 'nama_anggota'
                            },
                            {
                                data: 'tanggal_jatuh_tempo',
                                name: 'tanggal_jatuh_tempo'
                            },
                            {
                                data: 'angsuran_pokok',
                                name: 'angsuran_pokok',
                                render: function(data) {
                                    return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }) : '-';
                                }
                            },
                            {
                                data: 'bunga',
                                name: 'bunga',
                                render: function(data) {
                                    return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }) : '-';
                                }
                            },
                            {
                                data: 'status_pelunasan',
                                name: 'status_pelunasan'
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return '<div class="row justify-content-center">' +
                                        '<div class="col-auto">' +
                                        '<a href="{{ route('pinjaman.show', '') }}/' + data.id_pinjaman +
                                        '" style="font-size: 10pt" class="btn btn-secondary m-1 edit-btn" ' +
                                        'data-id="' + data.id +
                                        '">Lihat</a>' +
                                        '</div>' +
                                        '</div>';
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
        <script src="{{ $shuChart->cdn() }}"></script>
        <script src="{{ $transaksiChart->cdn() }}"></script>

        {{ $shuChart->script() }}
        {{ $transaksiChart->script() }}
    @endif
@endsection
