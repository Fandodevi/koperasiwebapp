<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Pegawai</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No. Handphone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pegawai as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>"{{ $value->nik }}"</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->jenis_kelamin }}</td>
                <td>{{ $value->alamat }}</td>
                <td>{{ $value->no_telp }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
