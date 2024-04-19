@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
    </nav>
@endsection

@section('content')
    <main class="container">
        <div class="layout-wrapper layout-content-navbar">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3 order-0 mb-4">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Pegawai</h5>
                                        {{-- <small class="text-muted">42.82k Total Sales</small> --}}
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="orederStatistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                    </div>
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
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Anggota</h5>
                                        {{-- <small class="text-muted">42.82k Total Sales</small> --}}
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="orederStatistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                    </div>
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
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Simpanan</h5>
                                        {{-- <small class="text-muted">42.82k Total Sales</small> --}}
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="orederStatistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                    </div>
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
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Pinjaman</h5>
                                        {{-- <small class="text-muted">42.82k Total Sales</small> --}}
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="orederStatistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                    </div>
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
                    <div class="row mt-4">
                        <div class="col-lg-7 mb-lg-0 mb-4">
                            <div class="card z-index-2 h-100">
                                <div class="card-header pb-0 pt-3 bg-transparent">
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
                        <div class="col-lg-5">
                            <div class="card card-carousel overflow-hidden h-100 p-0">
                                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                                    <div class="carousel-inner border-radius-lg h-100">
                                        <div class="carousel-item h-100 active"
                                            style="background-image: url('./assets/img/carousel-1.jpg');
                      background-size: cover;">
                                            <div
                                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                <div
                                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                    <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                                </div>
                                                <h5 class="text-white mb-1">Get started with Argon</h5>
                                                <p>There’s nothing I really wanted to do in life that I wasn’t able to get
                                                    good at.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item h-100"
                                            style="background-image: url('./assets/img/carousel-2.jpg');
                      background-size: cover;">
                                            <div
                                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                <div
                                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                    <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                                </div>
                                                <h5 class="text-white mb-1">Faster way to create web pages</h5>
                                                <p>That’s my skill. I’m not really specifically talented at anything except
                                                    for the ability to learn.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item h-100"
                                            style="background-image: url({{ asset('style/assets/img/carousel-3.jpg') }}); background-size: cover;">
                                            <div
                                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                <div
                                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                    <i class="ni ni-trophy text-dark opacity-10"></i>
                                                </div>
                                                <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                                <p>Don’t be afraid to be wrong because you can’t learn anything from a
                                                    compliment.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev w-5 me-3" type="button"
                                        data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next w-5 me-3" type="button"
                                        data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection