<!--header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="/">
            @if ( settings('appDarkLogo') )
                <img src="{{ settings('appDarkLogo') }}" alt="{{ settings('appName') ?? config('app.name') }}">
            @else
                {{ settings('appName') ?? config('app.name') }}
            @endif
        </a>
        <a class="navbar-brand brand-logo-mini" href="/">
            @if ( settings('appMiniDarkLogo') )
                <img src="{{ settings('appMiniDarkLogo') }}" alt="{{ settings('appName') ?? config('app.name') }}">
            @else
                {{ settings('appName') ?? config('app.name') }}
            @endif
        </a>
    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        {{-- <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li> --}}
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti-bell"></i>
                {{-- <span class="badge badge-danger notification-status"> </span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>{{ __('Notifications') }}</strong>
                    {{-- <span class="badge badge-pill badge-warning">05</span> --}}
                </div>
                <div class="dropdown-divider"></div>
                <p class="dropdown-item">{{ __('There are no notifications.') }}</p>
                {{-- <a href="#" class="dropdown-item">New registered user <small
                        class="float-right text-muted time">Just now</small> </a>
                <a href="#" class="dropdown-item">New invoice received <small
                        class="float-right text-muted time">22 mins</small> </a>
                <a href="#" class="dropdown-item">Server error report<small
                        class="float-right text-muted time">7 hrs</small> </a>
                <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                        days</small> </a>
                <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                        days</small> </a> --}}
            </div>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big">
                <div class="dropdown-header">
                    <strong>{{ __('Quick Links') }}</strong>
                </div>
                <div class="dropdown-divider"></div>
                <div class="nav-grid">
                    <a href="{{ route('pilgrims_management') }}" class="nav-grid-item"><i class="fa fa-users text-primary"></i>
                        <h5>{{ __('Pilgrims') }}</h5>
                    </a>
                    <a href="{{ route('units_management') }}" class="nav-grid-item"><i class="fa fa-home text-success"></i>
                        <h5>{{ __('الخيام') }}</h5>
                    </a>
                </div>
                <div class="nav-grid">
                    <a href="{{ route('admin_settings') }}" class="nav-grid-item"><i class="fa fa-cog text-warning"></i>
                        <h5>{{ __('Settings') }}</h5>
                    </a>
                    <a href="{{ route('dashboard_users') }}" class="nav-grid-item"><i class="fa fa-user-secret text-danger "></i>
                        <h5>{{ __('Users') }}</h5>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                @livewire('profile.avatar')
            </a> 

            @guest
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('login') }}"><i class="text-secondary fa fa-sign-in"></i>{{ __('Login') }}</a>
            </div>
            @else
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="text-warning ti-user"></i>{{ __('Profile') }}</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                    
                        <button class="dropdown-item" style="cursor: pointer">
                            <i class="text-danger ti-unlock"></i>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            @endguest
            
        </li>
    </ul>
</nav>
<!--header End-->