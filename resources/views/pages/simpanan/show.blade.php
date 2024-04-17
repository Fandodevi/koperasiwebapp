@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Data Detail Simpanan</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Data Detail Simpanan</h6>
    </nav>
@endsection

@section('content')

    <body class="bg-light">
        <main class="container">
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                {!! session('msg') !!}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <div class="d-flex align-items-end row">
                    @foreach ($simpanan as $index => $item)
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Detail Simpanan</h5>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-8">
                                        <p class="mt-4">
                                            No Anggota : {{ $item->anggota->no_anggota }}
                                        </p>
                                        <p class="mb-4">
                                            Nama : {{ $item->anggota->nama }}
                                        </p>
                                        <p class="mb-4">
                                            Alamat : {{ $item->anggota->alamat }}
                                        </p>
                                        <p class="mb-4">
                                            Tanggal Masuk : {{ $item->anggota->tanggal_masuk }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mt-4">
                                            Saldo : Rp {{ number_format($item->total_saldo, 2, ',', '.') }}
                                        </p>
                                        <p class="mb-4">
                                            Simpanan Pokok : Rp {{ number_format($total_simpanan_pokok, 2, ',', '.') }}
                                        </p>
                                        <p class="mb-4">
                                            Simpanan Wajib : Rp {{ number_format($total_simpanan_wajib, 2, ',', '.') }}
                                        </p>
                                        <p class="mb-4">
                                            Simpanan Sukarela : Rp
                                            {{ number_format($total_simpanan_sukarela, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="table-responsive p-0">
                    <table class="table table-hover table-bordered align-items-center" id="myTable">
                        <thead style="font-size: 10pt">
                            <tr style="background-color: rgb(187, 246, 201)">
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Jenis Transaksi</th>
                                <th class="text-center">Simpanan Pokok</th>
                                <th class="text-center">Simpanan Wajib</th>
                                <th class="text-center">Simpanan Sukarela</th>
                                <th class="text-center">Saldo</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" style="font-size: 10pt">
                        </tbody>
                    </table>
                </div>
                <div class="pb-2 mt-4">
                    <a href='{{ route('simpanan') }}' class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </main>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}'
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ route('simpanan.show', '') }}/' + data.id_simpanan +'",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'jenis_transaksi',
                            name: 'jenis_transaksi'
                        },
                        {
                            data: 'simpanan_pokok',
                            name: 'simpanan_pokok',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                        {
                            data: 'simpanan_wajib',
                            name: 'simpanan_wajib',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                        {
                            data: 'simpanan_sukarela',
                            name: 'simpanan_sukarela',
                            render: function(data) {
                                return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }) : '-';
                            }
                        },
                        {
                            data: 'subtotal_saldo',
                            name: 'subtotal_saldo',
                            render: function(data) {
                                return parseInt(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                            }
                        },
                        {
                            data: null,
                            render: function(data) {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<a href="" style="font-size: 10pt" class="btn btn-warning m-1 edit-btn" ' +
                                    'data-id="' + data.id +
                                    '">Edit</a>' +
                                    '<a href="" style="font-size: 10pt" class="btn btn-danger m-1 delete-btn" ' +
                                    'data-id="' + data.id +
                                    '">Hapus</a>' +
                                    '</div>' +
                                    '</div>';
                            }
                        }
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
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script> --}}
    </body>
@endsection
