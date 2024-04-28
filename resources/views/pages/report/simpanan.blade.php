<!DOCTYPE html>
<html>

<head>
    <title>Laporan PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: small;
        }

        h1 {
            color: blue;
            text-align: center;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
        }

        p {
            color: green;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        @media only screen and (max-width: 600px) {
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                text-align: center;
                padding: 6px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Simpanan Anggota Koperasi</h1>
        @foreach ($simpanan as $value)
            <div class="row d-flex justify-content-between">
                <div class="col-md-6">
                    <p>No Anggota: {{ $value->anggota->no_anggota }}</p>
                    <p>Jenis Anggota: {{ $value->anggota->jenis_anggota }}</p>
                    <p>Nama Anggota: {{ $value->anggota->nama }}</p>
                    <p>Alamat: {{ $value->anggota->alamat }}</p>
                    <p>Tanggal Masuk: {{ $value->anggota->tanggal_masuk }}</p>
                </div>
                <div class="col-md-6">
                    <p>Total Saldo: {{ number_format($value->total_saldo, 2, ',', '.') }}</p>
                    <p>Saldo Simpanan Pokok: Rp {{ number_format($totalSimpananPokok, 2, ',', '.') }}</p>
                    <p>Saldo Simpanan Wajib: Rp {{ number_format($totalSimpananWajib, 2, ',', '.') }}</p>
                    <p>Saldo Simpanan Sukarela: Rp {{ number_format($totalSimpananSukarela, 2, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Transaksi</th>
                    <th>Simpanan Pokok</th>
                    <th>Simpanan Wajib</th>
                    <th>Simpanan Sukarela</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailSimpanan as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->created_at }}</td>
                        <td>{{ $detail->jenis_transaksi }}</td>
                        <td>Rp {{ number_format($detail->simpanan_pokok, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->simpanan_wajib, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->simpanan_sukarela, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal_saldo, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
