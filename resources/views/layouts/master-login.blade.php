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
</head>

<body class="bg-gradient-login">
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('resources/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/admin.min.js') }}"></script>
</body>

</html>