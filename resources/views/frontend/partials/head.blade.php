<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-url" content="{{ env('APP_URL') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('settings.app.company_name') }} - @yield('title')</title>

    <link rel="manifest" href="{{ url('public/assets/fav.ico') }}/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('public/assets/fav.ico') }}/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="shortcut icon" href="{{ company_fav_icon(@base_settings('company_icon')) }}"
            type="image/x-icon" >

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Theme style -->
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/frontend.css') }}">
    <link rel="stylesheet" href="{{ asset('/') }}public/frontend/assets/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}public/frontend/assets/animate.min.css">

    <link rel="stylesheet" href="{{ asset('public/vendors/') }}/lineawesome/css/line-awesome.min.css">
    
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('/') }}public/frontend/css/plugins.css">
    <link rel="stylesheet" href="{{ asset('public/css/toastr.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('/') }}public/frontend/css/responsive.css">
    {{-- move to --}}
    <link rel="stylesheet" href="{{ asset('/') }}public/frontend/assets/css/header.css">


    @yield('style')

</head>

<body>
