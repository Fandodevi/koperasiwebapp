@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Data Detail Pinjaman</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Data Detail Pinjaman</h6>
    </nav>
@endsection

@section('content')

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
                @foreach ($pinjaman as $index => $item)
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Detail Pinjaman</h5>
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-8">
                                    <p class="mt-4">
                                        No Anggota : {{ $item->anggota->no_anggota }}
                                    </p>
                                    <p class="mt-4">
                                        Nama : {{ $item->anggota->nama }}
                                    </p>
                                    <p class="mt-4">
                                        Besar Pinjaman : Rp {{ number_format($item->total_pinjaman, 2, ',', '.') }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mt-4">
                                        No. Pinjaman : {{ $item->no_pinjaman }}
                                    </p>
                                    <p class="mt-4">
                                        Tanggal Realisasi : {{ $item->tanggal_realisasi }}
                                    </p>
                                    <p class="mt-4">
                                        Angsuran : Rp {{ number_format($angsuran->subtotal_angsuran, 2, ',', '.') }} x
                                        {{ $item->angsuran }}
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
                            <th class="text-center">Tanggal Jatuh Tempo</th>
                            <th class="text-center">Angsuran Ke-</th>
                            <th class="text-center">Angsuran Pokok</th>
                            <th class="text-center">Bunga 1%</th>
                            <th class="text-center">Angsuran Per-bulan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="font-size: 10pt">
                    </tbody>
                </table>
            </div>
            <div class="pb-2 mt-4">
                <a href='{{ route('pinjaman') }}' class="btn btn-secondary">Kembali</a>
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
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
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
                ajax: {
                    url: '{{ route('pinjaman.show', ['id' => ':id']) }}'.replace(':id', window.location
                        .href.split('/').pop()),
                    method: 'GET',
                    dataSrc: 'data'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal_jatuh_tempo',
                        name: 'tanggal_jatuh_tempo'
                    },
                    {
                        data: 'angsuran_ke_',
                        name: 'angsuran_ke_'
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
                        data: 'subtotal_angsuran',
                        name: 'subtotal_angsuran',
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
                            var status_pelunasan = data.status_pelunasan == 'Lunas' ? 'disabled' :
                                '';

                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<a href="{{ route('pinjaman.update', '') }}/' + data.id_pinjaman +
                                '" style="font-size: 10pt" class="btn btn-info m-1 edit-btn" ' +
                                'data-id="' + data.id +
                                '" ' + status_pelunasan + '>Bayar</a>' +
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
@endsection
