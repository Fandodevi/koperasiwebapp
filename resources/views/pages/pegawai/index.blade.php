@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Data Pegawai</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Data Pegawai</h6>
    </nav>
@endsection

@section('content')

    <body class="bg-light">
        <main class="container">
            <div class="my-3 p-3 bg-body rounded shadow-sm">


                <!-- TOMBOL TAMBAH DATA -->
                <div class="d-flex justify-content-between">
                    <div class="pb-2">
                        <a href='{{ route('pegawai.create') }}' class="btn btn-primary">+ Tambah Data</a>
                    </div>
                    <div class="pb-2">
                        <a href='{{ route('pegawai.export') }}' class="btn btn-secondary">Cetak PDF</a>
                    </div>
                </div>

                {{-- <div class="pb-2">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-succes" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                </div> --}}

                <div class="table-responsive p-0">
                    <table class="table table-hover table-bordered align-items-center" id="myTable">
                        <thead style="font-size: 10pt">
                            <tr style="background-color: rgb(187, 246, 201)">
                                <th class="text-center">No</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">No Handphone</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" style="font-size: 10pt">
                        </tbody>
                    </table>
                    {{-- {{ $data->links() }} --}}

                </div>
            </div>

            <!-- AKHIR DATA -->
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
                    ajax: "{{ route('pegawai') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nik',
                            name: 'nik'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'no_telp',
                            name: 'no_telp'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<a href="{{ route('pegawai.edit', '') }}/' + data.id_users +
                                    '" style="font-size: 10pt" class="btn btn-info m-1 edit-btn" ' +
                                    'data-id="' + data.id +
                                    '">Edit</a>' +
                                    '</div>' +
                                    '<div class="col-auto">' +
                                    '<a href="{{ route('pegawai.destroy', '') }}/' + data.id_users +
                                    '" style="font-size: 10pt" class="btn btn-danger m-1 delete-btn" ' +
                                    'data-id="' + data.id +
                                    '">Hapus</a>' +
                                    '</div>' +
                                    '</div>';
                            }
                        }
                    ],
                    buttons: [
                        'excel'
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
