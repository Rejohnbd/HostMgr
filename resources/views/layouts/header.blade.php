<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('resources/assets/img/logo.png') }}" rel="icon">
  <title>HostMgr :: @yield('title')</title>
  {{-- Styles --}}
  <link href="{{ asset('resources/assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/assets/css/admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/assets/css/main.css') }}" rel="stylesheet">
  @if(Request::is('domain-resellers*') || Request::is('hosting-resellers*') || Request::is('customers') || Request::is('services*') )
  <link href="{{ asset('resources/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  @endif
  @if(Request::is('customers/create') || Request::is('customers/*/edit') || Request::is('services/create') || Request::is('domain-reseller/*/renew') || Request::is('hosting-reseller/*/renew') || Request::is('invoices/*/create'))
  <link href="{{ asset('resources/assets/vendor/select-option/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/assets/vendor/datetimepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
  @endif
  <script src="{{ asset('resources/assets/vendor/jquery/jquery.min.js') }}"></script>
</head>

<body id="page-top">
  <div id="wrapper">
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    {{-- /Sidebar --}}
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        {{-- /Topbar --}}
        {{-- Container Fluid--}}
        <div class="container-fluid" id="container-wrapper">