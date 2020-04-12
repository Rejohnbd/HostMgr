<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('img/logo.png') }}" rel="icon">
  <title>HostMgr :: @yield('title')</title>
  {{-- Styles --}}
  <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">

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