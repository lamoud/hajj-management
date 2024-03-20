<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ App::getLocale() === 'en' ? 'ltr' : 'rtl' }}">
<head>
    @include('admin.layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--Start preloader -->
        <div id="pre-loader">
            <img src="{{ asset('admin/assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>
        <!-- End preloader -->

        @include('admin.layouts.main-header')

        <div class="container-fluid">
            <div class="row">

                @include('admin.layouts.main-sidebar')

                <!--Start Main content -->
                <!-- main-content -->
                <div class="content-wrapper">

                    @yield('page-header')

                    @yield('content')

                    <!--Start  wrapper -->

                    <!-- Start footer -->

                    @include('admin.layouts.footer')
                </div><!-- End main content wrapper -->
            </div>
        </div>
    </div>

    <!-- Start footer -->
    @livewireScripts
    @include('admin.layouts.footer-scripts')

</body>

</html>
