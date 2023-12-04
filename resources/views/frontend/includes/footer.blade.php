<script src="{{ asset('/') }}public/frontend/assets/jquery.min.js"></script>
<script src="{{ asset('/') }}public/frontend/assets/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('/') }}public/frontend/assets/slick.min.js"></script>
<script src="{{ asset('/') }}public/frontend/js/mixitup.min.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__header.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__accordion.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__scrollUp.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__sideMenuLang.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__mobileViewNavMenu.js"></script>
<script src="{{ asset('/') }}public/frontend/js/wow.min.js"></script>
<script src="{{ asset('/') }}public/frontend/js/image_preview.js"></script>
<script src="{{ asset('/') }}public/frontend/js/navbar.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__animation.js"></script>
<script src="{{ asset('/') }}public/frontend/js/__apexChart.js"></script>
<script src="{{ asset('/') }}public/frontend/js/slider.js"></script>


<script src="{{ asset('/') }}public/frontend/assets/js/iziToast.js"></script>
<script src="{{ asset('public/frontend/js/v1/__g_footer.js') }}"></script>


<script src="{{ asset('/') }}public/frontend/js/__footer.js"></script>


<script src="{{ asset('/') }}public/backend/js/select2.min.js"></script>





<div id="fb-root"></div>
<!-- Your customer chat code -->

<script src="{{ asset('/') }}public/js/3.5.1.chart.min.js"></script>
<script src="{{ asset('/') }}public/backend/plugins/moment/moment.min.js"></script>
<script src="{{ asset('/') }}public/js/bootstrap-datetimepicker.min.js"></script>


<!-- jQuery -->
<script src="{{ asset('public/backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend/js/adminlte.min.js') }}"></script>
{{-- iziToast --}}
<script src="{{ asset('public/frontend/assets/js/iziToast.js') }}"></script>

<script src="{{ asset('public/backend/') }}/js/select2.min.js"></script>

@include('backend.partials.message')
<script src="{{ asset('public/js/toastr.js') }}"></script>
{!! Toastr::message() !!}
@stack('script')

@yield('script')
</body>

</html>
