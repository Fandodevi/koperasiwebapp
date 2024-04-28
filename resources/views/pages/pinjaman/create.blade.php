@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah Data Pinjaman</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Tambah Data Pinjaman</h6>
    </nav>
@endsection

@section('content')
    <main class="container">

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ route('pinjaman') }}" class="btn btn-secondary">Kembali</a>
            <div class="table-responsive p-0">
                <table class="table table-hover table-bordered align-items-center" id="myTable">
                    <thead style="font-size: 10pt">
                        <tr style="background-color: rgb(187, 246, 201)">
                            <th class="text-center">No</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">No. Anggota</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal Masuk</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Pekerjaan</th>
                            <th class="text-center">No. Handphone</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="font-size: 10pt">
                    </tbody>
                </table>
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
                ajax: "{{ route('anggota') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'no_anggota',
                        name: 'no_anggota'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal_masuk',
                        name: 'tanggal_masuk'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan'
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
                                '<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#basicModal' +
                                data.id_anggota + '">Pilih</button>' +
                                '<div class="modal fade" id="basicModal' + data.id_anggota +
                                '" tabindex="-1">' +
                                '<div class="modal-dialog modal-lg">' +
                                '<div class="modal-content">' +
                                '<div class="modal-header">' +
                                '<h5 class="modal-title">' + data.nama + '</h5>' +
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '</div>' +
                                '<div class="modal-body text-start">' +
                                '<form id="formPinjaman' + data.id_anggota +
                                '" action="{{ route('pinjaman.store') }}" method="POST" enctype="multipart/form-data">' +
                                '@csrf' +
                                '<input type="hidden" class="form-control" id="id_anggota" name="id_anggota" value="' +
                                data.id_anggota + '" required>' +
                                '<div class="mb-3 row">' +
                                '<label for="angsuran' + data.id_anggota +
                                '" class="col-sm-2 col-form-label">Angusan Pinjaman</label>' +
                                '<div class="col-sm-12">' +
                                '<input type="number" class="form-control" id="angsuran' + data
                                .id_anggota +
                                '" name="angsuran" placeholder="Masukkan Angsuran" max="12" min="1" required>' +
                                '</div>' +
                                '</div>' +
                                '<div class="mb-3 row">' +
                                '<label for="nominal_pinjaman' + data.id_anggota +
                                '" class="col-sm-2 col-form-label">Nominal</label>' +
                                '<div class="col-sm-12">' +
                                '<input type="text" class="form-control" id="nominal_pinjaman' +
                                data.id_anggota +
                                '" name="nominal_pinjaman" placeholder="Masukkan Nominal" required>' +
                                '</div>' +
                                '</div>' +
                                '</form>' +
                                '</div>' +
                                '<div class="modal-footer">' +
                                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                                '<button type="submit" form="formPinjaman' + data.id_anggota +
                                '" class="btn btn-primary">Simpan</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
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
