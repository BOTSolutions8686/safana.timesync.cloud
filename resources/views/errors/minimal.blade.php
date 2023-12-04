@include('frontend.includes.header')

<div class=" new-main-content">
    <div class="ltn__contact-address-area mt-70 mb-50 ">
        <div class="container">
            <section class="page_404">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class=" grayColor2 fs_90">{{ _trans('project.Oops!') }}</h1>
                            <h4>{{ _trans('project.Error Code:') }} @yield('code')</h4>
                            <h3 class="h2 grayColor2">
                                @yield('message')
                            </h3>

                            <p>@yield('details')</p>

                            <a href="{{ url('/') }}" class="link_404">{{ _trans('project.Go to Home') }}</a>
                        </div>
                        <div class="col-md-4">
                            <div class="error-img">
                                <img src="/public/images/error.gif" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('frontend.includes.footer')
