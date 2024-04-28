<!DOCTYPE html>
<html>

<head>
    <title>Laporan PDF</title>
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
    <h1>Laporan Anggota Koperasi</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>No Anggota</th>
                <th>Nama Anggota</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No. Handphone</th>
                <th>Pekerjaan</th>
                <th>Tanggal Masuk</th>
                <th>Jenis Anggota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->no_anggota }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->pekerjaan }}</td>
                    <td>{{ $item->tanggal_masuk }}</td>
                    <td>{{ $item->jenis_anggota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
