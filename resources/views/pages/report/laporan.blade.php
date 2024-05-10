<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            margin-top: 20px;
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
        <h3>LABA/RUGI {{ $tahun }}</h3>
        <h3>KSP BANGUN KARYA DESA</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Uraian</th>
                    <th>{{ $tanggal_cetak }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>I. Pendapatan</b></td>
                    <td> </td>
                </tr>
                <tr>
                    <td>Pendapatan Bunga</td>
                    <td class="jumlah">Rp. {{ number_format($total_pendapatan_bunga, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>SHU Kotor</b></td>
                    <td class="jumlah">Rp. {{ number_format($total_pendapatan_bunga, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td><b>II. Beban Operasional</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Beban Usaha</td>
                    <td></td>
                </tr>
                @foreach ($beban_operasional as $item)
                    <tr>
                        <td>- Beban {{ $item->keterangan }}</td>
                        <td class="jumlah">Rp. {{ number_format($item->jumlah_uang, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><b>Total Beban Operasional</b></td>
                    <td class="jumlah">Rp. {{ number_format($total_beban_operasional, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td><b>III. Sisa Hasil Usaha</b></td>
                    <td class="jumlah">Rp. {{ number_format($sisa_hasil_usaha, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                </tr>
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
