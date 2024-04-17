@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit Data Pegawai</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Edit Data Pegawai</h6>
    </nav>
@endsection

@section('content')
    <main class="container">
        <form action="{{ route('pegawai.update', $users->id_users) }}" method='POST' enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                        <input type="text" class="form-control" id="nik" name='nik' value="{{ $users->nik }}"
                            placeholder="Masukkan NIK" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama" name='nama' value="{{ $users->nama }}"
                            placeholder="Masukkan Nama Lengkap" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" name='email' value="{{ $users->email }}"
                            placeholder="Masukkan Email" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-12">
                        <select class="form-select cursor-pointer" aria-label="Default select example" id="jeniskelamin"
                            name="jeniskelamin" required>
                            @if ($users->jenis_kelamin == 'Laki-Laki')
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="{{ $users->jenis_kelamin }}" selected>{{ $users->jenis_kelamin }}</option>
                                <option value="Perempuan">Perempuan</option>
                            @elseif ($users->jenis_kelamin == 'Perempuan')
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="{{ $users->jenis_kelamin }}" selected>{{ $users->jenis_kelamin }}</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                            @else
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name='alamat' value="{{ $users->alamat }}"
                            placeholder="Masukkan Alamat" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="noTelp" class="col-sm-2 col-form-label">No Handphone</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="noTelp" name='noTelp'
                            value="{{ $users->no_telp }}" placeholder="Masukkan No Handphone" required>
                    </div>
                </div>

                <div class="mb-3 row mt-5">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <a href="{{ route('pegawai') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">Perbarui</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
