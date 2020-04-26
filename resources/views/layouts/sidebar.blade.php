<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('resources/assets/img/logo.png') }}">
    </div>
    <div class="sidebar-brand-text mx-3">HostMgr</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item @if(Request::is('dashboard')) active @endif">
    <a class="nav-link" href="{{ url('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Customer
  </div>
  <li class="nav-item @if(Request::is('customers*')) active @endif">
    <a class="nav-link" href="{{ route('customers.index') }}">
      <i class="fas fa-users"></i>
      <span>Customers</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Services
  </div>
  <li class="nav-item @if(Request::is('services*')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
      <i class="fas fa-archive"></i>
      <span>Services</span>
    </a>
    <div id="collapseServices" class="collapse @if(Request::is('services*')) show @endif" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('services.index') }}">All Services</a>
        <a class="collapse-item" href="#">Service Renew</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Packages
  </div>
  <li class="nav-item @if(Request::is('hosting-packages*')) active @endif">
    <a class="nav-link" href="{{ route('hosting-packages.index') }}">
      <i class="fas fa-box"></i>
      <span>Hosting Package</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Reseller
  </div>
  <li class="nav-item @if(Request::is('domain-resellers*')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDomain" aria-expanded="true" aria-controls="collapseDomain">
      <i class="fab fa-hornbill"></i>
      <span>Domain</span>
    </a>
    <div id="collapseDomain" class="collapse @if(Request::is('domain-resellers*')) show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item @if(Request::is('domain-resellers*')) active @endif" href="{{ route('domain-resellers.index') }}">Domain Resellers</a>
        <a class="collapse-item" href="#">Domain Resellers Renew</a>
      </div>
    </div>
  </li>
  <li class="nav-item @if(Request::is('hosting-resellers*')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHosting" aria-expanded="true" aria-controls="collapseHosting">
      <i class="fas fa-hdd"></i>
      <span>Hosting</span>
    </a>
    <div id="collapseHosting" class="collapse @if(Request::is('hosting-resellers*')) show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item @if(Request::is('hosting-resellers*')) active @endif" href="{{ route('hosting-resellers.index') }}">Hosting Resellers</a>
        <a class="collapse-item" href="#">Hosting Resellers Renew</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">
</ul>