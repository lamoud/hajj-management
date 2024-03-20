<!-- topbar__section__stert -->
<div class="topbararea topbararea--2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="topbar__left">
                    <ul>
                        <li>
                            {{ __('Call Us') }}: {{ settings('appMobile') }}
                        </li>
                        <li>
                            - {{ __('Mail Us') }}: {{ settings('appMail') }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="topbar__right">
                    <div class="topbar__icon">
                        <i class="icofont-location-pin"></i>
                    </div>
                    <div class="topbar__text">
                        <p>{{ settings('appAddress') }}</p>
                    </div>
                    <div class="topbar__list">
                        <ul>
                            <li>
                                <a href="{{ settings('appFaceboke') ?? 'javascript:void(0)' }}"><i class="icofont-facebook"></i></a>
                            </li>
                            <li>
                                <a href="{{ settings('appTwiter') ?? 'javascript:void(0)' }}"><i class="icofont-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{ settings('appInstagram') ?? 'javascript:void(0)' }}"><i class="icofont-instagram"></i></a>
                            </li>
                            <li>
                                <a href="{{ settings('appYoutube') ?? 'javascript:void(0)' }}"><i class="icofont-youtube-play"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- topbar__section__end -->

<!-- headar section start -->
<header>
<div class="headerarea headerarea__2 header__sticky header__area">
    <div class="container desktop__menu__wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-6">
                <div class="headerarea__left">
                    <div class="headerarea__left__logo" style="height: 100px">

                        <a href="/">
                            @if ( settings('appLogo') )
                                <img src="{{ settings('appLogo') }}" alt="{{ settings('appName') ?? config('app.name') }}" style="height: 100%">
                            @else
                                {{ settings('appName') ?? config('app.name') }}
                            @endif
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-xl-7 col-lg-7 main_menu_wrap">
                <div class="headerarea__main__menu">
                    <nav>
                        <ul>

                        <li><a class="headerarea__has__dropdown" href="javascript:void(0)">{{ __('Important links') }}
                                <i class="icofont-rounded-down"></i>
                            </a>
                            <ul class="headerarea__submenu">
                                <li><a href="{{ route('terms.show') }}">{{ __('Terms of Service') }}</a></li>
                                <li><a href="{{ route('policy.show') }}">{{ __('Privacy Policy') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="headerarea__has__dropdown" href="{{ route('blog') }}">{{ __('Blog') }}</a>
                        </li>
                            

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="headerarea__right">
                    <div class="header__cart">
                        <a href="#"> <i class="icofont-cart-alt"></i></a>
                        <div class="header__right__dropdown__wrapper">
                            <div class="header__right__dropdown__inner">
                                
                                <div class="single__header__right__dropdown">
                                    {{ __('Your Cart is empty!') }}
                                </div>

                                {{-- <div class="single__header__right__dropdown">

                                    <div class="header__right__dropdown__img">
                                        <a href="#">
                                            <img src="{{ asset('theme/img/cart1.jpg') }}" alt="photo">
                                        </a>
                                    </div>
                                    <div class="header__right__dropdown__content">

                                        <a href="shop-product.html">Web Directory</a>
                                        <p>1 x <span class="price">$ 80.00</span></p>

                                    </div>
                                    <div class="header__right__dropdown__close">
                                        <a href="#"><i class="icofont-close-line"></i></a>
                                    </div>
                                </div>

                                <div class="single__header__right__dropdown">

                                    <div class="header__right__dropdown__img">
                                        <a href="#">
                                            <img src="{{ asset('theme/img/cart2.jpg') }}" alt="photo">
                                        </a>
                                    </div>
                                    <div class="header__right__dropdown__content">

                                        <a href="shop-product.html">Design Minois</a>
                                        <p>1 x <span class="price">$ 60.00</span></p>

                                    </div>
                                    <div class="header__right__dropdown__close">
                                        <a href="#"><i class="icofont-close-line"></i></a>
                                    </div>
                                </div>

                                <div class="single__header__right__dropdown">

                                    <div class="header__right__dropdown__img">
                                        <a href="#">
                                            <img src="{{ asset('theme/img/cart3.jpg') }}" alt="photo">
                                        </a>
                                    </div>
                                    <div class="header__right__dropdown__content">

                                        <a href="shop-product.html">Crash Course</a>
                                        <p>1 x <span class="price">$ 70.00</span></p>

                                    </div>
                                    <div class="header__right__dropdown__close">
                                        <a href="#"><i class="icofont-close-line"></i></a>
                                    </div>
                                </div> --}}
                            </div>

                            <p class="dropdown__price">{{ __('Total') }}: <span>$0</span>
                            </p>
                            <div class="header__right__dropdown__button">
                                <a href="#" class="white__color">{{ __('View Cart') }}</a>
                                <a href="#" class="blue__color">{{ __('Checkout') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    @auth
                        <div class="headerarea__main__menu">
                            <nav>
                                <ul>

                                <li><a class="headerarea__has__dropdown" href="javascript:void(0)">
                                    @livewire('profile.avatar')
                                    <i class="icofont-rounded-down"></i>
                                </a>
                                <ul class="headerarea__submenu">
                                    
                                    @can('admin_view')
                                        <li><a href="{{ route('dashboard') }}"><i class="icofont-dashboard-web"></i>{{ __('Dashboard') }}<span class="mega__menu__label">{{ Auth::user()->role }}</span></a></li>
                                    @endcan
                                    <li><a href="{{ route('profile.show') }}" style="justify-content: start; gap: 4px;"><i class="icofont-user-alt-5"></i> {{ __('Profile') }}</a></li>
                                    <li><a href="{{ route('profile_settings') }}" style="justify-content: start; gap: 4px;"><i class="icofont-settings"></i> {{ __('Profile settings') }}</a></li>
                                    <hr>

                                    <form id="logout_form" method="POST" action="{{ route('logout') }}" x-data style="display: none">
                                        @csrf
                                    </form>              
                                    <li><a href="javascript:void(0)"onclick="document.querySelector('#logout_form').submit()"><i class="icofont-logout"></i> {{ __('Log out') }}</a></li>
                                </ul>
                            </li>
                                    
                                </ul>
                            </nav>
                        </div>
                    @else
                        
                        <div class="headerarea__main__menu">
                            <nav>
                                <ul>

                                    <li><a class="headerarea__has__dropdown" href="javascript:void(0)">
                                            <i class="icofont-user-alt-5"></i>
                                            <i class="icofont-rounded-down"></i>
                                        </a>
                                        <ul class="headerarea__submenu">
                                            
                                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </nav>
                        </div>
                        <div class="headerarea__button">
                            <a href="{{ route('profile_platforms') }}">{{ __('Get Start') }}</a>
                        </div>
                    @endauth
                </div>
            </div>

        </div>

    </div>


    <div class="container-fluid mob_menu_wrapper">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="mobile-logo">
                    <a href="/">
                        @if ( settings('appLogo') )
                            <img src="{{ settings('appLogo') }}" alt="{{ settings('appName') ?? config('app.name') }}" style="height: 100%">
                        @else
                            {{ settings('appName') ?? config('app.name') }}
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="header-right-wrap">

                    <div class="headerarea__right">

                        <div class="header__cart">
                            <a href="#"> <i class="icofont-cart-alt"></i></a>
                            <div class="header__right__dropdown__wrapper">
                                <div class="header__right__dropdown__inner">
                                    
                                    <div class="single__header__right__dropdown">
                                        {{ __('Your Cart is empty!') }}
                                    </div>

                                    {{-- <div class="single__header__right__dropdown">

                                        <div class="header__right__dropdown__img">
                                            <a href="#">
                                                <img src="{{ asset('theme/img/cart1.jpg') }}" alt="photo">
                                            </a>
                                        </div>
                                        <div class="header__right__dropdown__content">

                                            <a href="shop-product.html">Web Directory</a>
                                            <p>1 x <span class="price">$ 80.00</span></p>

                                        </div>
                                        <div class="header__right__dropdown__close">
                                            <a href="#"><i class="icofont-close-line"></i></a>
                                        </div>
                                    </div>

                                    <div class="single__header__right__dropdown">

                                        <div class="header__right__dropdown__img">
                                            <a href="#">
                                                <img src="{{ asset('theme/img/cart2.jpg') }}" alt="photo">
                                            </a>
                                        </div>
                                        <div class="header__right__dropdown__content">

                                            <a href="shop-product.html">Design Minois</a>
                                            <p>1 x <span class="price">$ 60.00</span></p>

                                        </div>
                                        <div class="header__right__dropdown__close">
                                            <a href="#"><i class="icofont-close-line"></i></a>
                                        </div>
                                    </div>

                                    <div class="single__header__right__dropdown">

                                        <div class="header__right__dropdown__img">
                                            <a href="#">
                                                <img src="{{ asset('theme/img/cart3.jpg') }}" alt="photo">
                                            </a>
                                        </div>
                                        <div class="header__right__dropdown__content">

                                            <a href="shop-product.html">Crash Course</a>
                                            <p>1 x <span class="price">$ 70.00</span></p>

                                        </div>
                                        <div class="header__right__dropdown__close">
                                            <a href="#"><i class="icofont-close-line"></i></a>
                                        </div>
                                    </div> --}}
                                </div>

                                <p class="dropdown__price">{{ __('Total') }}: <span>$0</span>
                                </p>
                                <div class="header__right__dropdown__button">
                                    <a href="#" class="white__color">{{ __('View Cart') }}</a>
                                    <a href="#" class="blue__color">{{ __('Checkout') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mobile-off-canvas">
                        <a class="mobile-aside-button" href="#"><i class="icofont-navigation-menu"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<!-- header section end -->
<!-- Mobile Menu Start Here -->
<div class="mobile-off-canvas-active">
<a class="mobile-aside-close"><i class="icofont icofont-close-line"></i></a>
<div class="header-mobile-aside-wrap">
    <div class="mobile-search">
        <form class="search-form" action="#">
            <input type="text" placeholder="{{ __('Search') }}">
            <button class="button-search"><i class="icofont icofont-search-2"></i></button>
        </form>
    </div>
    <div class="mobile-menu-wrap headerarea">

        <div class="mobile-navigation">

            <nav>
                <ul class="mobile-menu">    
                </ul>
            </nav>

        </div>

    </div>
    <div class="mobile-curr-lang-wrap">
        <div class="single-mobile-curr-lang">
            <a class="mobile-language-active" href="#">
                {{ __('Language') }}
                <i class="icofont-rounded-down"></i>
            </a>
            <div class="lang-curr-dropdown lang-dropdown-active">
                <ul>
                    <li><a href="#">English (US)</a></li>
                    <li><a href="#">عربي</a></li>
                </ul>
            </div>
        </div>

        <div class="single-mobile-curr-lang">
            
            @auth
            <a class="mobile-account-active" href="#">
                @livewire('profile.avatar') {{ Auth::user()->name }}
                <i class="icofont-rounded-down"></i>
            </a>
            <div class="lang-curr-dropdown account-dropdown-active">
                <ul>
                    @can('admin_view')
                        <li><i class="fas fa-cog"></i><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    @endcan
                    <hr>
                    <li class="d-flex"><i class="icofont-user-alt-5"><a href="{{ route('profile.show') }}"></i> {{ __('Profile') }}</a></li>
                    <hr>
                    <li class="d-flex"><i class="icofont-settings"></i><a href="{{ route('profile_settings') }}"> {{ __('Profile settings') }}</a></li>
                    <hr>
                    <form id="logout_form" method="POST" action="{{ route('logout') }}" x-data style="display: none">
                        @csrf
                    </form>              
                    <li class="d-flex"><a href="javascript:void(0)"onclick="document.querySelector('#logout_form').submit()">{{ __('Log out') }}</a></li>
                </ul>
            </div>
        @else
            
            <a class="mobile-account-active" href="javascript:void(0)">
                <span class="icofont-user-alt-5"></span>
                <i class="icofont-rounded-down"></i>
            </a>
            <div class="lang-curr-dropdown account-dropdown-active">
                <ul>
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <br>
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
            </div>
            <br>
            <div class="headerarea__button">
                <a class="text-light" href="{{ route('profile_platforms') }}">{{ __('Get Start') }}</a>
            </div>
        @endauth
        </div>
    </div>
    <div class="mobile-social-wrap">
        <a class="facebook" href="{{ settings('appFaceboke') ?? 'javascript:void(0)' }}"><i class="icofont icofont-facebook"></i></a>
        <a class="twitter" href="{{ settings('appTwiter') ?? 'javascript:void(0)' }}"><i class="icofont icofont-twitter"></i></a>
        <a class="instagram" href="{{ settings('appInstagram') ?? 'javascript:void(0)' }}"><i class="icofont icofont-instagram"></i></a>
        <a class="google" href="{{ settings('appYoutube') ?? 'javascript:void(0)' }}"><i class="icofont icofont-youtube-play"></i></a>
    </div>
</div>
</div>
<!-- Mobile Menu End Here -->
<!-- theme fixed shadow -->
<div>
    <div class="theme__shadow__circle"></div>
    <div class="theme__shadow__circle shadow__right"></div>
</div>
<!-- theme fixed shadow -->