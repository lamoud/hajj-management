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
            <form action="{{ route('validate_admin_social') }}" method="post">
                @csrf
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Faceboke') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appFaceboke" class="form-control bg-white {{ $errors->has('appFaceboke') ? 'is-invalid' : '' }}" placeholder="{{ __('Faceboke') }}" value="{{ settings('appFaceboke') }}">
                        @if($errors->has('appFaceboke'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appFaceboke') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Twiter') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appTwiter" class="form-control bg-white {{ $errors->has('appTwiter') ? 'is-invalid' : '' }}" placeholder="{{ __('Twiter') }}" value="{{ settings('appTwiter') }}">
                        @if($errors->has('appTwiter'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appTwiter') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Instagram') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appInstagram" class="form-control bg-white {{ $errors->has('appInstagram') ? 'is-invalid' : '' }}" placeholder="{{ __('Instagram') }}" value="{{ settings('appInstagram') }}">
                        @if($errors->has('appInstagram'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appInstagram') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Youtube') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appYoutube" class="form-control bg-white {{ $errors->has('appYoutube') ? 'is-invalid' : '' }}" placeholder="{{ __('Youtube') }}" value="{{ settings('appYoutube') }}">
                        @if($errors->has('appYoutube'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appYoutube') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Whatsapp') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appWhatsapp" class="form-control bg-white {{ $errors->has('appWhatsapp') ? 'is-invalid' : '' }}" placeholder="{{ __('Whatsapp') }}" value="{{ settings('appWhatsapp') }}">
                        @if($errors->has('appWhatsapp'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appWhatsapp') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Phone') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appMobile" class="form-control bg-white {{ $errors->has('appMobile') ? 'is-invalid' : '' }}" placeholder="{{ __('Mobile') }}" value="{{ settings('appMobile') }}">
                        @if($errors->has('appMobile'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMobile') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Address') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appAddress" class="form-control bg-white {{ $errors->has('appAddress') ? 'is-invalid' : '' }}" placeholder="{{ __('Address') }}" value="{{ settings('appAddress') }}">
                        @if($errors->has('appAddress'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appAddress') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ __('Email') }}</div>
                    <div class="col-sm-9">
                        <input type="text" name="appMail" class="form-control bg-white {{ $errors->has('appMail') ? 'is-invalid' : '' }}" placeholder="{{ __('Mail') }}" value="{{ settings('appMail') }}">
                        @if($errors->has('appMail'))
                            <div class="invalid-feedback" style="display: block">{{ $errors->first('appMail') }}</div>
                        @endif
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

@endsection

