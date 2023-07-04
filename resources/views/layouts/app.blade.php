<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- shortcut icon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- css -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/morris.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/material.css')}}">
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
</head>
<body>
    <div id="app">
    <div class="main-wrapper">
    @include('layouts.partial.sidebar')
    @include('layouts.partial.header')
    
        <!-- <main class="py-4">
            @yield('content')
        </main> -->
        </div>
    </div>
</body>
</html>
