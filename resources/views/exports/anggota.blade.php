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
        @foreach ($anggota as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>"{{ $value->nik }}"</td>
                <td>"{{ $value->no_anggota }}"</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->jenis_kelamin }}</td>
                <td>{{ $value->alamat }}</td>
                <td>{{ $value->no_telp }}</td>
                <td>{{ $value->pekerjaan }}</td>
                <td>{{ $value->tanggal_masuk }}</td>
                <td>{{ $value->jenis_anggota }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
