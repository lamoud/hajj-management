@section('title', $title)
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('admin.layouts.master')

@section('content')
  <div class="page-title mb-20">
    <div class="row">
        <div class="col-sm-6">
        <h4 class="mb-0 d-flex align-items-center h-100">{{ $title }}</h4>
        </div>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
          <a class="button black x-small" href="javascript:void(0)" data-toggle="modal" data-target="#modal-bus">
            {{ __('Add new') }}
          </a>
        </div>
    </div>
  </div>

    @livewire('admin.services.service_providing')
    
@endsection