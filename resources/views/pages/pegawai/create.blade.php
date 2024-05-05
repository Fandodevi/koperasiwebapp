@extends('layouts.main')

@section('title', 'Pegawai')
@section('subtitle', 'Tambah Pegawai')

@section('content')
    <main class="container">
        @if (Auth::user()->id_role == 1)
            <form action="{{ route('admin.pegawai.store') }}" method='POST' enctype="multipart/form-data">
                @csrf
            @elseif (Auth::user()->id_role == 2)
                <form action="{{ route('pegawai.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
                @else
                    <form action="{{ route('pegawai.pegawai.store') }}" method='POST' enctype="multipart/form-data">
                        @csrf
        @endif
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            {!! session('msg') !!}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif
            <div class="mb-3 row">
                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nik" name='nik' value="{{ old('nik') }}"
                        placeholder="Masukkan NIK" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nama" name='nama' value="{{ old('nama') }}"
                        placeholder="Masukkan Nama Lengkap" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" name='email' value="{{ old('email') }}"
                        placeholder="Masukkan Email" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-12">
                    <select class="form-select cursor-pointer" aria-label="Default select example" id="jeniskelamin"
                        name="jeniskelamin" value="{{ old('jeniskelamin') }}" required>
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name='alamat' value="{{ old('alamat') }}"
                        placeholder="Masukkan Alamat" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="noTelp" class="col-sm-2 col-form-label">No Handphone</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="noTelp" name='noTelp' value="{{ old('noTelp') }}"
                        placeholder="Masukkan No Handphone" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" id="password" name='password'
                        value="{{ old('password') }}" placeholder="Masukkan Password" required>
                </div>
            </div>

            <div class="mb-3 row mt-5">
                <div class="col-sm-12 d-flex justify-content-between">
                    @if (Auth::user()->id_role == 1)
                        <a href="{{ route('admin.pegawai') }}" class="btn btn-secondary">Kembali</a>
                    @elseif (Auth::user()->id_role == 2)
                        <a href="{{ route('pegawai') }}" class="btn btn-secondary">Kembali</a>
                    @else
                        <a href="{{ route('pegawai.pegawai') }}" class="btn btn-secondary">Kembali</a>
                    @endif
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                </div>
            </div>
        </div>
        </form>
    </main>
@endsection
