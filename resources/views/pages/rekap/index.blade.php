@extends('layouts.main')

@section('title', 'Rekap Transaksi')
@section('subtitle', 'Data Rekap Transaksi')

@section('content')
    <main class="container">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- TOMBOL TAMBAH DATA -->
            <div class="d-flex justify-content-between">
                <div class="pb-2">
                    @if (Auth::user()->id_role == 2)
                        <form action="{{ route('rekap.export') }}" method="GET" class="form-control">
                            <span class="d-flex -mb-4">
                                <h5>Pilih Rentang Waktu :</h5>
                            </span>
                            @csrf
                            <div class="col d-flex justify-content-start align-items-center">
                                <input type="date" name="start_date" class="form-control h-50 me-2 mb-2" required>
                                <input type="date" name="end_date" class="form-control h-50 me-2 mb-2" required>
                                <button type="submit" class="btn btn-secondary">Cetak</button>
                            </div>
                        </form>
                    @elseif (Auth::user()->id_role == 3)
                        <a href='{{ route('pegawai.rekap.export') }}' class="btn btn-secondary">Cetak PDF</a>
                    @endif
                </div>
            </div>

            <div class="table-responsive p-0">
                <table class="table table-hover table-bordered align-items-center" id="myTable">
                    <thead style="font-size: 10pt">
                        <tr style="background-color: rgb(187, 246, 201)">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Pengguna</th>
                            <th class="text-center">Jenis Transaksi</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Total Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="font-size: 10pt">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

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
                        data: 'tipe_transaksi',
                        name: 'tipe_transaksi'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'total_saldo',
                        name: 'total_saldo',
                        render: function(data) {
                            return parseInt(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
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
@endsection
