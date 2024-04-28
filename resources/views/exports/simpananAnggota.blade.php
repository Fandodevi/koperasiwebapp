<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Anggota</th>
            <th>Jenis Anggota</th>
            <th>Nama Anggota</th>
            <th>Alamat</th>
            <th>Tanggal Masuk</th>
            <th>Total Saldo</th>
            <th>Saldo Simpanan Pokok</th>
            <th>Saldo Simpanan Wajib</th>
            <th>Saldo Simpanan Sukarela</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($simpanan as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>"{{ $value->anggota->no_anggota }}"</td>
                <td>{{ $value->anggota->jenis_anggota }}</td>
                <td>{{ $value->anggota->nama }}</td>
                <td>{{ $value->anggota->alamat }}</td>
                <td>{{ $value->anggota->tanggal_masuk }}</td>
                <td>{{ $value->total_saldo }}</td>
                <td>{{ $totalSimpananPokok }}</td>
                <td>{{ $totalSimpananWajib }}</td>
                <td>{{ $totalSimpananSukarela }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
