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
        <h1>Pinjaman Anggota Koperasi</h1>
        @foreach ($pinjaman as $value)
            <div class="row d-flex justify-content-between">
                <div class="col-md-6">
                    <p>No Anggota: {{ $value->anggota->no_anggota }}</p>
                    <p>Nama Anggota : {{ $value->anggota->nama }}</p>
                    <p>Besar Pinjaman : Rp {{ number_format($value->total_pinjaman, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <p>No. Pinjaman : {{ $value->no_pinjaman }}</p>
                    <p>Tanggal Realisasi: {{ $value->tanggal_realisasi }}</p>
                    <p>Angsuran : Rp {{ number_format($angsuran->subtotal_angsuran, 2, ',', '.') }} x
                        {{ $value->angsuran }}</p>
                </div>
            </div>
        @endforeach
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Angsuran Ke-</th>
                    <th>Angsuran Pokok</th>
                    <th>Bunga 1%</th>
                    <th>Angsuran Per-bulan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailPinjaman as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->tanggal_jatuh_tempo }}</td>
                        <td>{{ $detail->angsuran_ke_ }}</td>
                        <td>Rp {{ number_format($detail->angsuran_pokok, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->bunga, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal_angsuran, 2, ',', '.') }}</td>
                        <td>{{ $detail->status_pelunasan }}</td>
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
