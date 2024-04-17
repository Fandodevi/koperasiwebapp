<div class="min-height-300 bg-success position-absolute w-100"></div>
<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 me-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" target="_blank">
            {{-- <img src="/icon/koperasilogo.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <img src="/icon/logobaru.png" class="navbar-brand-img h-100" alt="main_logo"
                style="max-height: 40px; max-width:200px">
            {{-- <span class="ms-1 font-weight-bold" style="align-content: center">Koperasi Simpan Pinjam<br>Bangun Karya Desa</span> --}}

        </a>
    </div>


    <div class="horizontal dark mt-0  ">
        {{-- <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main"> --}}

        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link {{ set_active('dashboard') }}" href="{{ route('dashboard') }}">
                    <img src="{{ asset('/icon/menuicon/dashboard.png') }}"
                        class="navbar-brand-img h-50 2em text-center me-2" style="max-height: 30px; max-width: 25px"
                        alt="main_logo">
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ set_active('pegawai') }}" href="{{ route('pegawai') }}">
                    <img src="/icon/menuicon/customers.png" class="navbar-brand-img h-50 2em text-center me-2"
                        style="max-height: 30px; max-width: 25px" alt="main_logo">
                    <span class="nav-link-text ms-1">Pegawai</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ set_active('anggota') }}" href="{{ route('anggota') }}">
                    <img src="/icon/menuicon/customers.png" class="navbar-brand-img h-50 2em text-center me-2"
                        style="max-height: 30px; max-width: 25px" alt="main_logo">
                    <span class="nav-link-text ms-1">Anggota</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ set_active('simpanan') }}" href="{{ route('simpanan') }}">
                    <img src="/icon/menuicon/customers.png" class="navbar-brand-img h-50 2em text-center me-2"
                        style="max-height: 30px; max-width: 25px" alt="main_logo">
                    <span class="nav-link-text ms-1">Simpanan</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ set_active('pinjaman') }}" href="{{ route('pinjaman') }}">
                    <img src="/icon/menuicon/customers.png" class="navbar-brand-img h-50 2em text-center me-2"
                        style="max-height: 30px; max-width: 25px" alt="main_logo">
                    <span class="nav-link-text ms-1">Pinjaman</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ set_active('laporan') }}" href="{{ route('laporan') }}">
                    <img src="/icon/menuicon/customers.png" class="navbar-brand-img h-50 2em text-center me-2"
                        style="max-height: 30px; max-width: 25px" alt="main_logo">
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ set_active('user') }}" href="{{ route('logout') }}">
                    <img src="/icon/menuicon/sign-out.png" class="navbar-brand-img h-50 2em text-center me-2"
                        style="max-height: 30px; max-width: 25px" alt="main_logo">
                    <span class="nav-link-text ms-1">User</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                  <a class="nav-link" href="{{route('logout')}}" >
                    <img src="/icon/menuicon/sign-out.png" class="navbar-brand-img h-50 text-center me-2 " alt="main_logo"
                    style="max-height: 30px; max-width: 25px">
                    <span class="nav-link-text ms-1">Sign Out</span>
                  </a>
                </li> --}}





        </ul>
    </div>
    </div>


    {{-- <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
          <img class="w-50 mx-auto" src="style/assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
          <div class="card-body text-center p-3 w-100 pt-0">
            <div class="docs-info">
              <h6 class="mb-0">Need help?</h6>
              <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
            </div>
          </div>
        </div>
        <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div> --}}
</aside>
