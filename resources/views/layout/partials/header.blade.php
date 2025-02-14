<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo justify-content-center" href="{{ route('mgt.dashboard.index') }}">
      <img src="{{ url('assets/img/jkons-logo.png') }}" alt="logo" />
    </a>
    <a class="navbar-brand brand-logo-mini" href="{{ route('mgt.dashboard.index') }}">
      <img src="{{ url('assets/img/logo-saja.png') }}" alt="logo" />
    </a>
  </div>
  
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <h3 class="nav-title">Sistem Penjadwalan Konseling</h3>
    
    <div class="search-field d-none d-md-block">
      
    </div>

    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
          aria-expanded="false">
          <!-- <i class="mdi mdi-account-circle text-primary"></i> -->
          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{ auth()->user()->name }}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ route('mgt.profile.index') }}">
            <i class="mdi mdi-cached me-2 text-success"></i> Ganti Password </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}">
            <i class="mdi mdi-logout me-2 text-primary"></i> Keluar </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>