@extends('main')

@section('subjudul')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Simpanan Anggota</li>
  </ol>
  <h6 class="font-weight-bolder text-white mb-0">Simpanan Anggota</h6>
</nav>
@endsection

@section('content')
<body class="bg-light">
    <main class="container">
     <form>
     @csrf
     <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div>
            <div >
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <span id="nama">: {{$data->nama}}</span>
            </div>
        </div>
        <div >
            <div >
                <label for="email" class="col-sm-2 col-form-label">Alamat</label>
                <span id="email">: {{$data->alamat}}</span>
            </div>
        </div>
        <div>
            <div >
                <label for="email" class="col-sm-2 col-form-label">No Telepon</label>
                <span id="email">: {{$data->noTelp}}</span>
            </div>
        </div>
       
        <div>
            <div >
                <label for="number" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                <span id="number">: {{$data->tanggalmasuk}}</span>
            </div>
        </div>
     </div>
  </main>
</body>

<body class="bg-light">
    <main class="container">
        <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
  
  
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-2">
                <a href='admintambah' class="btn btn-primary">+ Tambah Data</a>
            </div>
  
            <!-- FORM PENCARIAN -->
            {{-- <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <form action="/pdam/admin" method="GET">
                        <input type="search" id="input" name="search" class="form-control"
                            aria-describedby="password">
                    </form>
                </div>
            </div> --}}
  
            <div class="col-md-3">
                <div class="form-group">
                    <form action="/pdam/admin" method="GET">
                        <div class="input-group">
                        <input id="input" name="search" class="form-control"
                             placeholder="Search...">
                        {{-- <button type="submit" class="btn btn-primary">Search </button> --}}
                        </div>
                    </form>
                </div>
            </div>
  
            <div class="pb-2">
                @if ($message = Session::get('success'))
                    <div class="alert alert-succes" role="alert">
                        {{ $message }}
                    </div>
                @endif
            </div>
        
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead style="font-size: 10pt">
                <tr style="background-color: rgb(187, 246, 201)">
                    <th class="col-md-1">Id</th>
                    <th class="col-md-2">Tanggal Simpan</th>
                    <th class="col-md-2">No Anggota</th>
                    <th class="col-md-2">Nominal</th>
                    <th class="col-md-2">Jenis Simpanan</th>
                    <th class="col-md-2">Action</th>
                </tr>
            </thead>
          
           
        </table>
            {{-- {{ $data->links() }} --}}
         
        </div>
    </div>
    
        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
  </body>

@endsection
  

  
