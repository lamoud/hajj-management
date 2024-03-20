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
<iframe src="/admin/filemanager" frameborder="0" style="width: 100%;height:100vh"></iframe>
{{-- @livewire('file-uploader')
@livewire('get-media') --}}
@endsection