<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('img/logo.png') }}">
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
    Features
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="far fa-fw fa-window-maximize"></i>
      <span>Bootstrap UI</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Bootstrap UI</h6>
        <a class="collapse-item" href="alerts.html">Alerts</a>
        <a class="collapse-item" href="buttons.html">Buttons</a>
        <a class="collapse-item" href="dropdowns.html">Dropdowns</a>
        <a class="collapse-item" href="modals.html">Modals</a>
        <a class="collapse-item" href="popovers.html">Popovers</a>
        <a class="collapse-item" href="progress-bar.html">Progress Bars</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="forms.html">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Forms</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span>
    </a>
    <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Tables</h6>
        <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
        <a class="collapse-item" href="datatables.html">DataTables</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="ui-colors.html">
      <i class="fas fa-fw fa-palette"></i>
      <span>UI Colors</span>
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
        <a class="collapse-item" href="{{ route('domain-resellers.index') }}">Domain Reseller List</a>
        <a class="collapse-item" href="{{ route('domain-resellers.create') }}">Domain Reseller Create</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHosting" aria-expanded="true" aria-controls="collapseHosting">
      <i class="fas fa-hdd"></i>
      <span>Hosting</span>
    </a>
    <div id="collapseHosting" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Example Pages</h6>
        <a class="collapse-item" href="login.html">Login</a>
        <a class="collapse-item" href="register.html">Register</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">
  <!-- <div class="version" id="version-ruangadmin"></div> -->
</ul>