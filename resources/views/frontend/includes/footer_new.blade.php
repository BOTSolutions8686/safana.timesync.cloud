<footer class="bg-footer-dark ">
    <div class="container">
        <div class="footer-section pt-100 pb-100">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo-content">
                        <div class="footer-section-logo">
                            @include('backend.auth.hrm_logo')
                        </div>
                        <div class="company-details">
                            <p>{{ @base_settings('company_description') }}</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 ">
                    <div class="middle-section">
                        <p class="mb-0 text-white">{{ _trans('frontend.Helpful Links') }}</p>
                        <ul class="helplink-list">
                            <li>
                                <a href="">{{ _trans('common.Contact') }}</a>
                            </li>
                            <li>
                                <a href="">{{ _trans('common.Privacy') }}</a>
                            </li>
                            <li>
                                <a href="">{{ _trans('common.Terms 0f Use') }}</a>
                            </li>
                            <li>
                                <a href="">{{ _trans('common.Log In') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apps">
                        <a href="">
                            <img src="{{ url('public/assets/images/playstore.png') }}" alt="">
                        </a>
                        <a href="">
                            <img src="{{ url('public/assets/images/appstore.png') }}" alt="">
                        </a>
                    </div>

                </div>
            </div>
            <div class="copyright">
                <p>{{ _trans('frontend.Copyright') }} {{ '@'.date('Y') }} <a href="#">{{ @base_settings('company_name') }}.</a> {{ _trans('frontend.All Rights Reserved.') }}</p>
            </div>
        </div>
       
    </div>

</footer>

<script src="{{ asset('public/backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/') }}public/frontend/js/__header.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__accordion.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__scrollUp.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__sideMenuLang.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__mobileViewNavMenu.js"></script>

<script src="{{ asset('/') }}public/frontend/js/slider.js"></script>

<div id="fb-root"></div>
<!-- Your customer chat code -->



@include('backend.partials.message')
<script src="{{ asset('public/js/toastr.js') }}"></script>
{!! Toastr::message() !!}

</body>



</html>
