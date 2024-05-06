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
        <h1>Rekap Transaksi Koperasi</h1>
        <div class="row d-flex justify-content-between">
            <div class="col-md-6">
                <p>Pendapatan: Rp {{ number_format($pendapatan, 2, ',', '.') }}</p>
                <p>Pemasukan : Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</p>
                <p>Pengeluaran : Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</p>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Jenis Transaksi</th>
                    <th>Tanggal</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapData as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->users->nama }}</td>
                        <td>{{ $item->tipe_transaksi }}</td>
                        <td>{{ $item->created_at->format('d-m-Y h:i:s') }}</td>
                        <td>Rp {{ number_format($saldo[$index], 2, ',', '.') }}</td>
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
