    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="{{ settings('appIcon') }}" type="image/x-icon" /> --}}

    {!! seo($SEOData ?? null) !!}

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/aos.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/icofont/icofont.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/slick/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/swiper@9/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/izitoast/css/iziToast.min.css') }}">

    @livewireStyles
    @if (App::getLocale() == 'ar')
        <link  rel="stylesheet" href="{{ url('frontend/assets/css/rtl.css') }}">
    @endif

    @yield('css')
    <!-- End css files -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem("theme-color") === "dark" || (!("theme-color" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
          document.documentElement.classList.add("is_dark");
        } 
        if (localStorage.getItem("theme-color") === "light") {
          document.documentElement.classList.remove("is_dark");
        } 
    </script>