<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- shortcut icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">
    <!-- css -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/morris.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/material.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-datetimepicker.min.css')}}" />
     <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/line-awesome.min.css')}}">
    <!-- Scripts -->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('frontend/js/morris.min.js')}}"></script>
    <script src="{{asset('frontend/js/raphael.min.js')}}"></script>
    <script src="{{asset('frontend/js/chart.js')}}"></script>
    <script src="{{asset('frontend/js/greedynav.js')}}"></script>
    <script src="{{asset('frontend/js/layout.js')}}"></script>
    <script src="{{asset('frontend/js/theme-settings.js')}}"></script>
    <script src="{{asset('frontend/js/app.js')}}"></script>
    <script src="{{asset('frontend/js/select2.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('frontend/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    
</head>
<body>
    <div id="app">
    @include('sweetalert::alert')
    @yield('user-not-login')
    <div class="main-wrapper">
    @if (Request::is('admin*'))
    @include('admin.layouts.includes.sidebar')
    @include('admin.layouts.includes.header')
    @endif
    <div class="page-wrapper">

    @yield('content')
       
         </div>
        </div>
    </div>
    @yield('script')
</body>
</html>
