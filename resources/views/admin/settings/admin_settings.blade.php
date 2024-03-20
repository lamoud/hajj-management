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
            <form action="{{ route('validate_admin_settings') }}" method="post">
                @csrf
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Site name') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appName" class="form-control bg-white {{ $errors->has('appName') ? 'is-invalid' : '' }}" placeholder="{{ __('Site name') }}" value="{{ settings('appName') ?? config('app.name') }}">
                        @if($errors->has('appName'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appName') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Site description') }}</div>
                    <div class="col-sm-9">
                        <textarea  name="appDisc" class="form-control bg-white {{ $errors->has('appDisc') ? 'is-invalid' : '' }}" placeholder="{{ __('Description') }}">{{ settings('appDisc') }}</textarea>
                        @if($errors->has('appDisc'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appDisc') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Key words') }}</div>
                    <div class="col-sm-9">
                        <textarea  name="appMetaTags" class="form-control bg-white {{ $errors->has('appMetaTags') ? 'is-invalid' : '' }}" placeholder="{{ __('key1, key2, key3, ...') }}">{{ settings('appMetaTags') }}</textarea>
                        @if($errors->has('appMetaTags'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMetaTags') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Site logo') }}</div>
                    <div class="col-sm-9">
                        <div class="blog-box blog-2" onclick="filemanager.selectFile('appLogo')" style="max-width: 150px">
                            <img class="img-fluid w-100" id="appLogo-preview" src="{{ settings('appLogo') ?? placeholder() }}" alt="">
                        </div>
                        <input name="appLogo" type="text" class="form-control" id="appLogo" value="{{ old('appLogo') ?? settings('appLogo') }}" style="display: none">

                        @if($errors->has('appLogo'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appLogo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Mini logo') }}</div>
                    <div class="col-sm-9">
                        <div class="blog-box blog-2" onclick="filemanager.selectFile('appMiniLogo')" style="max-width: 150px">
                            <img class="img-fluid w-100" id="appMiniLogo-preview" src="{{ settings('appMiniLogo') ?? placeholder() }}" alt="">
                        </div>
                        <input name="appMiniLogo" type="text" class="form-control" id="appMiniLogo" value="{{ old('appMiniLogo') ?? settings('appMiniLogo') }}" style="display: none">

                        @if($errors->has('appMiniLogo'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMiniLogo') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Site dark logo') }}</div>
                    <div class="col-sm-9">
                        <div class="blog-box blog-2" onclick="filemanager.selectFile('appDarkLogo')" style="max-width: 150px">
                            <img class="img-fluid w-100" id="appDarkLogo-preview" src="{{ settings('appDarkLogo') ?? placeholder() }}" alt="">
                        </div>
                        <input name="appDarkLogo" type="text" class="form-control" id="appDarkLogo" value="{{ old('appDarkLogo') ?? settings('appDarkLogo') }}" style="display: none">

                        @if($errors->has('appDarkLogo'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appDarkLogo') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Mini dark logo') }}</div>
                    <div class="col-sm-9">
                        <div class="blog-box blog-2" onclick="filemanager.selectFile('appMiniDarkLogo')" style="max-width: 150px">
                            <img class="img-fluid w-100" id="appMiniDarkLogo-preview" src="{{ settings('appMiniDarkLogo') ?? placeholder() }}" alt="">
                        </div>
                        <input name="appMiniDarkLogo" type="text" class="form-control" id="appMiniDarkLogo" value="{{ old('appMiniDarkLogo') ?? settings('appMiniDarkLogo') }}" style="display: none">

                        @if($errors->has('appMiniDarkLogo'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMiniDarkLogo') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Site icon') }}</div>
                    <div class="col-sm-9">
                        <div class="blog-box blog-2" onclick="filemanager.selectFile('appIcon')" style="max-width: 150px">
                            <img class="img-fluid w-100" id="appIcon-preview" src="{{ settings('appIcon') ?? placeholder() }}" alt="">
                        </div>
                        <input name="appIcon" type="text" class="form-control" id="appIcon" value="{{ old('appIcon') ?? settings('appIcon') }}" style="display: none">

                        @if($errors->has('appIcon'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appIcon') }}</div>
                        @endif
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

@endsection

