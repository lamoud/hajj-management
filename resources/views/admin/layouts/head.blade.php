{!! seo($SEOData ?? null) !!}
@livewireStyles
<!-- Favicon -->
<link rel="shortcut icon" href="{{ settings('appIcon') }}" type="image/x-icon" />

@yield('css')
<!--- Style css -->
<link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/izitoast/css/iziToast.min.css') }}">


<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ asset('admin/assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ asset('admin/assets/css/rtl.css') }}" rel="stylesheet">
@endif
@FilemanagerScript
