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

            <form action="{{ route('validate_dashboard_users_new') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Start form inputs --}}
                    <div class="col-md-9">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label" for="name">{{ __('The name') }}</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="{{ __('Enter name') }}" value="{{ old('name') }}">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback" style="display: block">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            
                                <div class="mb-3">
                                    <label class="form-label" for="email">{{ __('The email') }}</label>
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('Enter email') }}" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback" style="display: block">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                                        
                                <div class="mb-3">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                    <input type="text" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback" style="display: block">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End form inputs --}}
                    {{-- Start form acctions --}}
                    <div class="col-md-3">
                        <div class="card card-statistics mb-20">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Role') }}</h5>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="role">{{ __('Role') }}</label>
                                    </div>
                                    <select name="role" class="custom-select" id="role">
                                        @forelse ($roles as $role)
                                            <option value="{{ $role->name }}"  {{ old('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    @if($errors->has('role'))
                                        <div class="invalid-feedback" style="display: block">{{ $errors->first('role') }}</div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>

                        <div class="card card-statistics">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Save') }}</h5>
                                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                            </div>
                        </div>
                        
                    </div>
                    {{-- End form acctions --}}
                </div>
            </form>
        </div>
    </div>
@endsection

