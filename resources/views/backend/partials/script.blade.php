    <!-- jQuery -->
    <script src="{{ asset('public/vendors/') }}/jquery/jquery-3.6.0.min.js"></script>
    <!--  Bootstrap 5 -->
    <script src="{{ asset('public/vendors/') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('public/vendors/') }}/bootstrap/js/bootstrap.min.js"></script>
    <!-- RTL -->
    <script src="{{ asset('public/vendors/') }}/rtlcss/js/semantic.min.js"></script>
    <!-- Metis Menu -->
    <script src="{{ asset('public/vendors/') }}/metis-menu/js/metis-menu.min.js"></script>
    <!-- date ranger -->
    <script src="{{ asset('public/vendors/') }}/daterangepicker/js/moment.min.js"></script>
    <script src="{{ asset('public/vendors/') }}/daterangepicker/js/daterangepicker.min.js"></script>
    <!-- Swwet alert -->
    <script src="{{ asset('public/vendors/') }}/sweet-alert/js/sweetalert2@11.min.js"></script>
    <script src="{{ asset('public/vendors/') }}/select2/js/select2.min.js"></script>
    {{-- Js --}}
    <script src="{{ asset('public/backend/') }}/js/jquery-ui.js"></script>
    {{-- toastr --}}
    <script src="{{ asset('public/js/toastr.js') }}"></script>
    {!! Toastr::message() !!}
   @if (Session::has('toastr'))
        @dd(Session::get('toastr'))
    @endif 
    {{-- toastr --}}
    <script src="{{ asset('public/js/') }}/tooltip.js"></script>
    <script src="{{ asset('public/js/') }}/newmain.js"></script>
    <script src="{{ asset('public/js/') }}/theme.js" async></script>
    <!-- Input Tags -->
    <script src="{{ asset('public/vendors/') }}/inputtags/tagsinput.js"></script>
    <script src="{{ asset('public/backend/js/main.js') }}"></script>
    <script src="{{ asset('public/js/') }}/select2-init.js"></script>
    @stack('scripts')
    {{-- axios load --}}
    <script src="{{ asset('public/js/axios.js') }}"></script>
    {{-- axios load --}}
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    </script>
    <script src="{{ asset('public/backend/js/fs_d_ecma/configuration/configuration.js') }}"></script>