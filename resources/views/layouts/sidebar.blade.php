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
  <li class="nav-item @if(Request::is('services*') || Request::is('service-types*') || Request::is('invoices*')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
      <i class="fas fa-archive"></i>
      <span>Services</span>
    </a>
    <div id="collapseServices" class="collapse @if(Request::is('services*') || Request::is('service-types*') || Request::is('invoices/*/create')) show @endif" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item  @if(Request::is('services*') || Request::is('invoices/*/create')) active @endif" href="{{ route('services.index') }}">All Services</a>
        <a class="collapse-item  @if(Request::is('services-expire-soon')) active @endif" href="{{ route('services-expire-soon') }}">Expired Soon Services</a>
        <a class="collapse-item  @if(Request::is('services-expired')) active @endif" href="{{ route('services-expired') }}">Expired Services</a>
        <a class="collapse-item @if(Request::is('service-types*')) active @endif" href="{{ route('service-types.index') }}">Service Type</a>
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
    <a class="nav-link" href="{{ route('domain-resellers.index') }}">
      <i class="fab fa-hornbill"></i>
      <span>Domain Resellers</span>
    </a>
  </li>
  <li class="nav-item @if(Request::is('hosting-resellers*')) active @endif">
    <a class="nav-link" href="{{ route('hosting-resellers.index') }}">
      <i class="fas fa-hdd"></i>
      <span>Hosting Resellers</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Invoices
  </div>
  <li class="nav-item @if(Request::is('invoices')) active @endif">
    <a class="nav-link" href="{{ route('invoices') }}">
      <i class="fas fa-file-alt"></i>
      <span>Invoices</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Accounts & Expenses
  </div>
  <li class="nav-item @if(Request::is('payments')) active @endif">
    <a class="nav-link" href="{{ route('payments.index') }}">
      <i class="fas fa-money-bill"></i>
      <span>Payments</span>
    </a>
  </li>
  <li class="nav-item @if(Request::is('expenses')) active @endif">
    <a class="nav-link" href="{{ route('expenses.index') }}">
      <i class="fas fa-money-bill"></i>
      <span>Expenses</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Email
  </div>
  <li class="nav-item @if(Request::is('email-templates*') || Request::is('email-send')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmail" aria-expanded="true" aria-controls="collapseEmail">
      <i class="fas fa-envelope"></i>
      <span>Email</span>
    </a>
    <div id="collapseEmail" class="collapse @if(Request::is('email-templates*') || Request::is('email-send')) show @endif" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item  @if(Request::is('email-templates*')) active @endif" href="{{ route('email-templates.index') }}">Template</a>
        <a class="collapse-item  @if(Request::is('email-send')) active @endif" href="{{ route('email-send') }}">Email</a>
      </div>
    </div>
  </li>
</ul>