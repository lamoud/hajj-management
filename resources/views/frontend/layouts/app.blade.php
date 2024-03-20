{{-- @section('title', $title) --}}

@extends('layouts/master')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Styles -->
{{-- @livewireStyles --}}
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <main>
        {{ $slot }}
    </main>
    <!-- ***** Main Banner Area End ***** -->
    @livewireScripts
@endsection