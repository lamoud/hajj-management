@section('title', $title)
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('admin.layouts.master')

@section('content')
    <div class="page-title mb-20">
        <div class="row">
            <div class="col-sm-6">
            <h4 class="mb-0 d-flex align-items-center h-100">{{ $title }}</h4>
            </div>
        </div>
    </div>

    @livewire('admin.pilgrims.pilgrims_management_actions')
    
@endsection