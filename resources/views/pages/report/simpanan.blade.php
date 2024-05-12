<!DOCTYPE html>
<html>

<head>
    <title>Laporan PDF</title>
    <style>
        /* CSS untuk styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
            border: 2px solid black;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header p {
            font-size: 18px;
            margin: 0;
        }

        .content {
            text-align: center;
            border: 2px solid black;
            border-top: none;
        }

        .content h3 {
            margin: 0;
        }

        .content .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .content .table th,
        .content .table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .content .table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .jumlah {
            text-align: end;
        }

        .content .ttd {
            width: 100%;
            border: none;
            margin-bottom: 20px;
        }

        .content .ttd th {
            font-weight: normal;
        }

        .content .ttd td {
            text-align: center;
            padding-top: 60px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>KOPERASI SIMPAN PINJAM</h1>
        <h1>"BANGUN KARYA DESA"</h1>
        <p>BH Nomor : AHU-000032.AH.01.26.TAHUN 2019, 15-11-2019</p>
        <p>Jl. Sunan Muria no.34 001/003 Kebonsari Wetan, Kec. Kanigaran</p>
    </div>
    <div class="content">
        <h3>DATA SIMPANAN ANGGOTA</h3>
        <h3>KSP BANGUN KARYA DESA</h3>
        @foreach ($simpanan as $value)
            <table class="table" style="border: none">
                <tbody style="border: none">
                    <tr>
                        <td style="width: 25%; border: none">No. Anggota</td>
                        <td style="width: 25%; border: none; text-align: left">: {{ $value->anggota->no_anggota }}</td>
                        <td style="width: 25%; border: none">Total Saldo</td>
                        <td style="width: 25%; border: none; text-align: left">:
                            {{ number_format($value->total_saldo, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%; border: none">Jenis Anggota</td>
                        <td style="width: 25%; border: none; text-align: left">: {{ $value->anggota->jenis_anggota }}
                        </td>
                        <td style="width: 25%; border: none">Saldo Simpanan Pokok</td>
                        <td style="width: 25%; border: none; text-align: left">: Rp
                            {{ number_format($totalSimpananPokok, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%; border: none">Nama Anggota</td>
                        <td style="width: 25%; border: none; text-align: left">: {{ $value->anggota->nama }}</td>
                        <td style="width: 25%; border: none">Saldo Simpanan Wajib</td>
                        <td style="width: 25%; border: none; text-align: left">: Rp
                            {{ number_format($totalSimpananWajib, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%; border: none">Tanggal Masuk</td>
                        <td style="width: 25%; border: none; text-align: left">: {{ $value->anggota->tanggal_masuk }}
                        </td>
                        <td style="width: 25%; border: none">Saldo Simpanan Sukarela</td>
                        <td style="width: 25%; border: none; text-align: left">: Rp
                            {{ number_format($totalSimpananSukarela, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach
        <table class="table" style="margin-bottom: 20px; font-size: x-small;">
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
        <table class="ttd">
            <thead>
                <tr>
                    <th style="width: 33,3%"></th>
                    <th style="width: 33,3%">PENGURUS KOPERASI</th>
                    <th style="width: 33,3%"></th>
                </tr>
                <tr>
                    <th style="width: 33,3%">Ketua</th>
                    <th style="width: 33,3%">Sekretaris</th>
                    <th style="width: 33,3%">Bendahara</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DWI ARIYANTI</td>
                    <td>SETYOWATI</td>
                    <td>SRI ISMANINGSIH</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
