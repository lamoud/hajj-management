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
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@php
    function imageBox($id, $setting) {
        $src = settings($setting);
        $placeholder = $src ? $src : '';
        $empty = !$src;
        return '
            <div class="blog-box blog-2" onclick="filemanager.selectFile(\'' . $id . '\')" style="max-width: 150px; border: 1px solid #ddd; text-align: center; background-color: #f9f9f9; padding: 5px;">
                ' . ($empty ? '<div style="padding:30px; font-size:13px; color:#aaa;">لا توجد صورة</div>' : '<img class="img-fluid w-100" id="' . $id . '-preview" src="' . $src . '" alt="">') . '
            </div>';
    }
@endphp

<div class="row mt-20">
    <div class="col-md-12 mb-30">
        <form action="{{ route('validate_admin_settings') }}" method="post">
            @csrf

            {{-- Site name --}}
            <div class="row align-items-center mb-20">
                <div class="col-sm-3">{{ __('Site name') }}</div>
                <div class="col-sm-9">
                    <input type="text" name="appName" class="form-control bg-white {{ $errors->has('appName') ? 'is-invalid' : '' }}" value="{{ settings('appName') ?? config('app.name') }}">
                    @error('appName')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Site description --}}
            <div class="row align-items-center mb-20">
                <div class="col-sm-3">{{ __('Site description') }}</div>
                <div class="col-sm-9">
                    <textarea name="appDisc" class="form-control bg-white {{ $errors->has('appDisc') ? 'is-invalid' : '' }}">{{ settings('appDisc') }}</textarea>
                    @error('appDisc')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Keywords --}}
            <div class="row align-items-center mb-20">
                <div class="col-sm-3">{{ __('Key words') }}</div>
                <div class="col-sm-9">
                    <textarea name="appMetaTags" class="form-control bg-white {{ $errors->has('appMetaTags') ? 'is-invalid' : '' }}">{{ settings('appMetaTags') }}</textarea>
                    @error('appMetaTags')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Images fields --}}
            @php
                $images = [
                    'appLogo' => __('Site logo'),
                    'appMiniLogo' => __('Mini logo'),
                    'appDarkLogo' => __('Site dark logo'),
                    'appMiniDarkLogo' => __('Mini dark logo'),
                    'appIcon' => __('Site icon'),
                    'apppPackground' => __('Auth background'),
                ];
            @endphp

            @foreach($images as $key => $label)
                <div class="row align-items-center mb-20">
                    <div class="col-sm-3">{{ $label }}</div>
                    <div class="col-sm-9">
                        {!! imageBox($key, $key) !!}
                        <input name="{{ $key }}" type="text" class="form-control" id="{{ $key }}" value="{{ old($key) ?? settings($key) }}" style="display: none">
                        @error($key)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach

            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
        </form>
    </div>
</div>

@endsection
