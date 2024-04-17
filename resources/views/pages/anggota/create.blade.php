@extends('layouts.main')

@section('subjudul')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah Data Anggota</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Tambah Data Anggota</h6>
    </nav>
@endsection

@section('content')
    <main class="container">
        <form action="{{ route('anggota.create') }}" method='POST' enctype="multipart/form-data">
            @csrf
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
                    <label for="nama" class="col-sm-2 col-form-label">Nama Langkap</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name='nama' id="nama" value="{{ old('nama') }}"
                            placeholder="Masukkan Nama Lengkap" required>
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
                        <input type="text" class="form-control" name='alamat' id="alamat" value="{{ old('alamat') }}"
                            placeholder="Masukkan Alamat" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="no_telp" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name='noTelp' id="no_telp"
                            value="{{ old('no_telp') }}" placeholder="Masukkan No Handphone" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name='pekerjaan' id="pekerjaan"
                            value="{{ old('pekerjaan') }}" placeholder="Masukkan Pekerjaan" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control" name='tanggalmasuk' id="tanggal_masuk"
                            value="{{ old('tanggalmasuk') }}" required>
                    </div>
                </div>

                <div class="mb-3 row mt-5">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <a href="{{ route('anggota') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    {{-- </body> --}}
@endsection
