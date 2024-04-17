@extends('main')
@section('subjudul')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-white active" aria-current="page">Data User</li>
  </ol>
  <h6 class="font-weight-bolder text-white mb-0">Data User</h6>
</nav>
@endsection

@section('content')
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
                  <th class="col-md-2">Nama</th>
                  <th class="col-md-2">Level</th>
                  <th class="col-md-2">Email</th>
                  <th class="col-md-2">Password</th>
                  <th class="col-md-2">No Telepon</th>
                  <th class="col-md-2">Alamat</th>
                  <th class="col-md-2">Action</th>
              </tr>
          </thead>
          <tbody class="table-bordered dataTable">
              @if ($data->count() > 0)
                  @foreach ($data as $item)
                      <tr style="font-size: 10pt" >
                          {{-- <th scope="item">{{$item}}</th> --}}
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->nama }}</td>
                          <td>{{ $item->level }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->password }}</td>
                          <td>{{ $item->noTelp}}</td>
                          <td>{{ $item->alamat}}</td>
                          <td>
                              {{-- <a href="/pdam/tampildata/{{ $item->id}}"  >
                                  <img src="/icon/menuicon/edit.png" style="max-height: 20px; max-width: 20px">
                              </a>
                              <a href="/pdam/delete/{{ $item->id }}" >
                                  <img src="/icon/menuicon/delete.png" style="max-height: 20px; max-width: 20px">
                              </a> --}}
                              
                              <a href="/tampildata/{{ $item->id}}" class="btn btn-success btn-sm">Edit</a>
                              <a href="/delete/{{ $item->id }}" class="btn btn-danger btn-sm">Delete</a>
                              
                          </td>
                      </tr>
                  @endforeach
              @else
                  <p>Tidak ada data.</p>
              @endif
          </tbody>
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