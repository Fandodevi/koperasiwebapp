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
                        @if (Auth::user()->id_role == 2)
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
        <script src="{{ $shuChart->cdn() }}"></script>
        <script src="{{ $transaksiChart->cdn() }}"></script>

        {{ $shuChart->script() }}
        {{ $transaksiChart->script() }}
    @endif
@endsection
