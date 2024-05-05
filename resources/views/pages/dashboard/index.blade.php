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
                                            <span>Total Pegawai</span>
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
                                            <span>Total Anggota</span>
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
                                            <span>Total Simpanan</span>
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
                                            <span>Total Pinjaman</span>
                                        </div>
                                        <div id="orderStatisticsChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-lg-0 my-4">
                            <div class="card border border-0 z-index-2 h-100">
                                <div class="card-header border border-0 pb-0 pt-3 bg-transparent">
                                    <h6 class="text-capitalize">Pendapatan</h6>
                                    <p class="text-sm mb-0">
                                        <i class="fa fa-arrow-up text-success"></i>
                                        <span class="font-weight-bold">4% more</span> in 2021
                                    </p>
                                </div>
                                <div class="card-body p-3">
                                    <div class="chart">
                                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-lg-0 my-4">
                            <div class="card border border-0 z-index-2 h-100">
                                <div class="card-header border border-0 pb-0 pt-3 bg-transparent">
                                    <h6 class="text-capitalize">Sumber Pendapatan</h6>
                                    <p class="text-sm mb-0">
                                        <i class="fa fa-arrow-up text-success"></i>
                                        <span class="font-weight-bold">4% more</span> in 2021
                                    </p>
                                </div>
                                <div class="card-body p-3">
                                    <div class="chart">
                                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
