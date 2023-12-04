<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-url" content="{{ env('APP_URL') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @base_settings('company_name') }} - @yield('title')</title>
    @if (env('APP_ENV') == 'server')
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <link rel="shortcut icon" href="{{ company_fav_icon(@base_settings('company_icon')) }}" type="image/x-icon" >

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/vendors/') }}/fontawesome/css/all.min.css">
    <!-- Line Awesome -->
    <link rel="stylesheet" href="{{ asset('public/vendors/') }}/lineawesome/css/line-awesome.min.css">
    <!--  Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('public/vendors/') }}/bootstrap/css/bootstrap.min.css">
    {{--  iziToast  --}}
    <!-- Swwet alert -->
    <link rel="stylesheet" href="{{ asset('public/vendors/') }}/sweet-alert/css/sweet-alert.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/backend/css/c-ui.css') }}">
    @yield('style')
</head>

<body class="default-theme" style="background-image: url(' {{ background_asset(@base_settings('backend_image')) }}')">
    <!-- main content start -->
    <main class="auth-page">
        <section class="auth-container">
            <div
                class="form-wrapper pv-80 ph-100 bg-white d-flex justify-content-center align-items-center flex-column">
                <div class="form-container d-flex justify-content-center align-items-start flex-column">
                    <div class="form-logo mb-40">
                        @include('frontend.partials.dark_logo')
                    </div>
                    @yield('content')
                </div>
            </div>
            <div class="d-flex justify-content-around pt-3">
                <small class="fw-light"><a href="{{route('privacyPolicy')}}">Privacy Policy</a></small>
                <small class="fw-light"><a href="{{route('termsAndConditions')}}">Terms & Conditions</a></small>
                <small class="fw-light"><a href="{{route('supportTwentyFour')}}">24/7 Support</a></small>
            </div>
        </section>
    </main>
    <!-- main content end -->
    <!-- vendors js  -->
    <script src="{{ asset('public/vendors/') }}/sweet-alert/js/sweetalert2@11.min.js"></script>
    @yield('script')
</body>
