<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    @include('frontend.layouts.partials.head')
</head>

<body>
    <main>

        <!-- pre loader area start -->
        <div id="back__preloader" style="display: none;">
            <div id="back__circle_loader"></div>
            <div class="back__loader_logo">
                <img src="{{ asset('frontend/img/pre.png') }}">
            </div>
        </div>
        <!-- pre loader area end -->

        <!-- Dark/Light area start -->
        <div class="mode_switcher my_switcher">
            <button id="light--to-dark-button" class="light align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon dark__mode" viewBox="0 0 512 512"><path d="M160 136c0-30.62 4.51-61.61 16-88C99.57 81.27 48 159.32 48 248c0 119.29 96.71 216 216 216 88.68 0 166.73-51.57 200-128-26.39 11.49-57.38 16-88 16-119.29 0-216-96.71-216-216z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"></path></svg>

                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon light__mode" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M256 48v48M256 416v48M403.08 108.92l-33.94 33.94M142.86 369.14l-33.94 33.94M464 256h-48M96 256H48M403.08 403.08l-33.94-33.94M142.86 142.86l-33.94-33.94"></path><circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"></circle></svg>

                <span class="light__mode">{{ __('Light') }}</span>
                <span class="dark__mode">{{ __('Dark') }}</span>
            </button>
        </div>
        <!-- Dark/Light area end -->

        @include('frontend.layouts.partials.main-header')

        @yield('content')

    </main>

    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials.footer-scripts')
</body>

</body>
</html>