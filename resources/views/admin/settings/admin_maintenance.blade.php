@section('title', $title)

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

    @if ($errors->any())
    <div class="alert alert-warning fade show" role="alert">
    {{ __('The given data was invalid.') }}
    </div>
    @endif

    @if ($message = Session::get('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif

    <div class="row mt-20">
        <div class="col-md-12 mb-30">
            <form action="{{ route('validate_admin_maintenance') }}" method="post">
                @csrf
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Maintenance mode') }}</div>
                    <div class="col-sm-9">
                        <div class="form-group mb-3">
                            <div class="checkbox checbox-switch switch-info">
                              <label>
                                <input type="checkbox" name="appMaintenance" {{ settings('appMaintenance') === 'on' ? 'checked' : '' }}>
                                <span></span>
                              </label>
                            </div>
                          </div>
                        @if($errors->has('appMaintenance'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMaintenance') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Content') }}</div>
                    <div class="col-sm-9">
                        <textarea  name="appMaintenanceContent" class="form-control bg-white {{ $errors->has('appMaintenanceContent') ? 'is-invalid' : '' }}" style="height: 300px">{{ settings('appMaintenanceContent') }}</textarea>
                        @if($errors->has('appMaintenanceContent'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMaintenanceContent') }}</div>
                        @endif
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

@endsection