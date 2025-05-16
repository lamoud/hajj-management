@section('title', 'الرئيسية')

@extends('admin.layouts.master')

@section('content')
    <div class="page-title mb-20">
        <div class="row">
            <div class="col-sm-6">
            <h4 class="mb-0">{{ $title }}</h4>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-danger">
                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Pilgrims') }}</p>
                    <h4>{{ $pilgrims ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('pilgrims_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All pilgrims') }}
                    </a>
                </p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-secondary">
                    <i class="fa fa-building highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Buildings') }}</p>
                    <h4>{{ $buildings ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('buildings_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All buildings') }}
                    </a>
                </p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-warning">
                    <i class="fa fa-home highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Units') }}</p>
                    <h4>{{ $units ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('units_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All units') }}
                    </a>
                </p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-success">
                    <i class="ti-layout-grid4 highlight-icon" aria-hidden="true" ></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Camps') }}</p>
                    <h4>{{ $camps ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('camps_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All camps') }}
                    </a>
                </p>
            </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-primary">
                    <i class="ti-package highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Agencies') }}</p>
                    <h4>{{ $agencies ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('agency_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All agencies') }}
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-primary">
                    <i class="fa fa-user-secret highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Users') }}</p>
                    <h4>{{ $users ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('dashboard_users') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All users') }}
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-success">
                    <i class="ti-layers-alt highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Roles') }}</p>
                    <h4>{{ $roles ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('admin_roles') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All roles') }}
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-danger">
                    <i class="fa fa-bus	 highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">{{ __('Buses') }}</p>
                    <h4>{{ $buses ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('buses_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> {{ __('All buses') }}
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-info">
                    <i class="fa fa-briefcase highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">المسميات الوظيفية</p>
                    <h4>{{ $jobs ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('employee_positions') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> جميع الوظائف
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-success">
                    <i class="fa fa-address-card highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">الموظفين</p>
                    <h4>{{ $emloyes ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('employees_management') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> جميع الموظفين
                    </a>
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <span class="text-warning">
                    <i class="fa fa-first-order	 highlight-icon" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="float-right text-end">
                    <p class="card-text text-dark">طلبات التوظيف</p>
                    <h4>{{ $emloyReq ?? 0 }}</h4>
                </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <a href="{{ route('employee_requests') }}">
                        <i class="fa fa-folder-open me-1" aria-hidden="true"></i> جميع الطلبات
                    </a>
                </p>
            </div>
            </div>
        </div>
        
    </div>

@endsection