<!-- Left Sidebar start-->
<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <!-- menu item Dashboard-->
            @php
                $home_route = ['admin_show'];
            @endphp
            <li class="{{ $pageType === 'admin_show' ? 'active' : '' }}">
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard" aria-expanded="{{ in_array($pageType, $home_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $home_route) ? '' : 'collapsed' }}">
                    <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('Home') }}</span>
                    </div>
                    <div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="dashboard" class="{{ in_array($pageType, $home_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                    <li class="{{ $pageType === 'admin_show' ? 'active' : '' }}"> <a href="{{ route('dashboard') }}">احصائيات</a> </li>
                </ul>
            </li>

            @can('season_view')
            {{-- Start season_management --}}
                    @php
                        $season_route = ['season_management'];
                    @endphp
                    <li class="{{ in_array($pageType, $season_route) ? 'active' : '' }}">
                        <a href="{{ route('season_management') }}" data-toggle="collapse" data-target="#season" aria-expanded="{{ in_array($pageType, $season_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $season_route) ? '' : 'collapsed' }}">
                            <div class="pull-left"><i class="ti-credit-card"></i><span class="right-nav-text">{{ __('Season management') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="season" class="{{ in_array($pageType, $season_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                            <li class="{{ $pageType === 'season_management' ? 'active' : '' }}"> <a href="{{ route('season_management') }}">{{ __('Season management') }}</a> </li>
                        </ul>
                    </li>
            {{-- End season_management --}}
            @endcan

            @can('agency_view')
            {{-- Start agency_management --}}
                    @php
                        $agency_route = ['agency_management'];
                    @endphp
                    <li class="{{ in_array($pageType, $agency_route) ? 'active' : '' }}">
                        <a href="{{ route('agency_management') }}" data-toggle="collapse" data-target="#agency" aria-expanded="{{ in_array($pageType, $agency_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $agency_route) ? '' : 'collapsed' }}">
                            <div class="pull-left"><i class="ti-package"></i><span class="right-nav-text">{{ __('Agency management') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="agency" class="{{ in_array($pageType, $agency_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                            <li class="{{ $pageType === 'agency_management' ? 'active' : '' }}"> <a href="{{ route('agency_management') }}">{{ __('Agency management') }}</a> </li>
                        </ul>
                    </li>
            {{-- End agency_management --}}
            @endcan

            @can('camps_view')
            {{-- Start camps-management --}}
                    @php
                        $camps_route = ['camps_management'];
                    @endphp
                    <li class="{{ in_array($pageType, $camps_route) ? 'active' : '' }}">
                        <a href="{{ route('camps_management') }}" data-toggle="collapse" data-target="#camps" aria-expanded="{{ in_array($pageType, $camps_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $camps_route) ? '' : 'collapsed' }}">
                            <div class="pull-left"><i class="ti-layout-grid4"></i><span class="right-nav-text">{{ __('Camps management') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="camps" class="{{ in_array($pageType, $camps_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                            <li class="{{ $pageType === 'camps_management' ? 'active' : '' }}"> <a href="{{ route('camps_management') }}">{{ __('Camps management') }}</a> </li>
                        </ul>
                    </li>
            {{-- End camps_management --}}
            @endcan

            @can('units_view')
            {{-- Start units-management --}}
                    @php
                        $units_route = ['units_management'];
                    @endphp
                    <li class="{{ in_array($pageType, $units_route) ? 'active' : '' }}">
                        <a href="{{ route('units_management') }}" data-toggle="collapse" data-target="#units" aria-expanded="{{ in_array($pageType, $units_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $units_route) ? '' : 'collapsed' }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('Units management') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="units" class="{{ in_array($pageType, $units_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                            <li class="{{ $pageType === 'units_management' ? 'active' : '' }}"> <a href="{{ route('units_management') }}">{{ __('Units management') }}</a> </li>
                        </ul>
                    </li>
            {{-- End units_management --}}
            @endcan

            @can('pilgrims_view')
            {{-- Start pilgrims-management --}}
                    @php
                        $pilgrims_route = ['pilgrims_management'];
                    @endphp
                    <li class="{{ in_array($pageType, $pilgrims_route) ? 'active' : '' }}">
                        <a href="{{ route('pilgrims_management') }}" data-toggle="collapse" data-target="#pilgrims" aria-expanded="{{ in_array($pageType, $pilgrims_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $pilgrims_route) ? '' : 'collapsed' }}">
                            <div class="pull-left"><i class="fa fa-users"></i><span class="right-nav-text">{{ __('Pilgrims management') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="pilgrims" class="{{ in_array($pageType, $pilgrims_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                            <li class="{{ $pageType === 'pilgrims_management' ? 'active' : '' }}"> <a href="{{ route('pilgrims_management') }}">{{ __('Pilgrims management') }}</a> </li>
                        </ul>
                    </li>
            {{-- End pilgrims_management --}}
            @endcan

            @can('buses_view')
            {{-- Start buses_management --}}
                    @php
                        $buses_route = ['buses_management'];
                    @endphp
                    <li class="{{ in_array($pageType, $buses_route) ? 'active' : '' }}">
                        <a href="{{ route('buses_management') }}" data-toggle="collapse" data-target="#buses" aria-expanded="{{ in_array($pageType, $buses_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $buses_route) ? '' : 'collapsed' }}">
                            <div class="pull-left"><i class="fa fa-bus"></i><span class="right-nav-text">{{ __('Buses management') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="buses" class="{{ in_array($pageType, $buses_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                            <li class="{{ $pageType === 'buses_management' ? 'active' : '' }}"> <a href="{{ route('buses_management') }}">{{ __('Buses management') }}</a> </li>
                        </ul>
                    </li>
            {{-- End buses_management --}}
            @endcan

            @can('media_view')
            {{-- Start media --}}
                @php
                    $media_route = ['admin_media', 'admin_media_new'];
                @endphp
                <li class="{{ in_array($pageType, $media_route) ? 'active' : '' }}">
                    <a href="{{ route('admin_media') }}" data-toggle="collapse" data-target="#media" aria-expanded="{{ in_array($pageType, $media_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $media_route) ? '' : 'collapsed' }}">
                        <div class="pull-left"><i class="ti-gallery"></i><span class="right-nav-text">{{ __('Media') }}</span>
                        </div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="media" class="{{ in_array($pageType, $media_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                        <li class="{{ $pageType === 'admin_media' ? 'active' : '' }}"> <a href="{{ route('admin_media') }}">{{ __('All media') }}</a> </li>
                    </ul>
                </li>
            {{-- End media --}}
            @endcan

            @can('roles_view')
            {{-- Start Roles --}}
                @php
                    $rolesRoutes = ['admin_roles', 'admin_roles_new'];
                @endphp
                <li class="{{ in_array($pageType, $rolesRoutes) ? 'active' : '' }}">
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#roles" aria-expanded="{{ in_array($pageType, $rolesRoutes) ? 'true' : 'false' }}" class="{{ in_array($pageType, $rolesRoutes) ? '' : 'collapsed' }}">
                        <div class="pull-left"><i class="ti-layers-alt"></i><span class="right-nav-text">{{ __('Roles') }}</span>
                        </div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="roles" class="{{ in_array($pageType, $rolesRoutes) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                        <li class="{{ $pageType === 'admin_roles' ? 'active' : '' }}"> <a href="{{ route('admin_roles') }}">{{ __('All roles') }}</a> </li>
                        @can('roles_view')
                            {{-- <li class="{{ $pageType === 'admin_roles_new' ? 'active' : '' }}"> <a href="{{ route('admin_roles_new') }}">{{ __('Add new') }}</a> </li> --}}
                        @endcan
                    </ul>
                </li>
            {{-- End Roles ti-settings --}}
            @endcan

            @can('users_view')
            {{-- Start Users --}}
                @php
                    $users_route = ['dashboard_users', 'dashboard_users_new', 'dashboard_users_update'];
                @endphp
                <li class="{{ in_array($pageType, $users_route) ? 'active' : '' }}">
                    <a href="{{ route('dashboard_users') }}" data-toggle="collapse" data-target="#users" aria-expanded="{{ in_array($pageType, $users_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $users_route) ? '' : 'collapsed' }}">
                        <div class="pull-left"><i class="fa fa-user-secret"></i><span class="right-nav-text">{{ __('Users') }}</span>
                        </div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="users" class="{{ in_array($pageType, $users_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                        <li class="{{ $pageType === 'dashboard_users' ? 'active' : '' }}"> <a href="{{ route('dashboard_users') }}">{{ __('All users') }}</a> </li>
                        
                            <li class="{{ $pageType === 'dashboard_users_new' ? 'active' : '' }}"> <a href="{{ route('dashboard_users_new') }}">{{ __('Add new') }}</a> </li>
                    </ul>
                </li>
            {{-- End Users --}}
            @endcan

            @can('settings_view')
            {{-- Start Settings --}}
                @php
                    $admin_settings_route = ['admin_settings', 'admin_appterms', 'admin_apppolicy', 'admin_maintenance', 'admin_social'];
                @endphp
                <li class="{{ in_array($pageType, $admin_settings_route) ? 'active' : '' }}">
                    <a href="{{ route('admin_settings') }}" data-toggle="collapse" data-target="#settings" aria-expanded="{{ in_array($pageType, $admin_settings_route) ? 'true' : 'false' }}" class="{{ in_array($pageType, $admin_settings_route) ? '' : 'collapsed' }}">
                        <div class="pull-left"><i class="ti-settings"></i><span class="right-nav-text">{{ __('Settings') }}</span>
                        </div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="settings" class="{{ in_array($pageType, $admin_settings_route) ? 'collapse show' : 'collapse' }}" data-parent="#sidebarnav">
                        <li class="{{ $pageType === 'admin_settings' ? 'active' : '' }}"> <a href="{{ route('admin_settings') }}">{{ __('General settings') }}</a> </li>
                        <li class="{{ $pageType === 'admin_social' ? 'active' : '' }}"> <a href="{{ route('admin_social') }}">{{ __('Social media') }}</a> </li>
                        <li class="{{ $pageType === 'admin_maintenance' ? 'active' : '' }}"> <a href="{{ route('admin_maintenance') }}">{{ __('Maintenance mode') }}</a> </li>
                        <li class="{{ $pageType === 'admin_appterms' ? 'active' : '' }}"> <a href="{{ route('admin_appterms') }}">{{ __('Terms of Service') }}</a> </li>
                        <li class="{{ $pageType === 'admin_apppolicy' ? 'active' : '' }}"> <a href="{{ route('admin_apppolicy') }}">{{ __('Privacy Policy') }}</a> </li>
                    </ul>
                </li>
            {{-- End Settings --}}
            @endcan

        </ul>
    </div>
</div>
<!-- Left Sidebar End-->