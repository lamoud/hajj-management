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
            <p><a target="_blank" href="{{ route('policy.show') }}">{{ __('Privacy Policy') }}</a></p>
            <form action="{{ route('validate_admin_apppolicy') }}" method="post">
                @csrf
                <div class="row align-items-center mb-20">
                    <textarea name="appPolicy" id="editor">{!! settings('appPolicy') !!}</textarea>
                </div>

                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

    <script src="{{ URL('admin/assets/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            height: 500,
            plugins: ['image', 'preview', 'media', 'lists', 'link', 'imagetools', 'contextmenu', 'print', 'table', 'textcolor', 'wordcount', 'directionality', 'fullscreen', 'visualblocks', 'autosave','emoticons'],
            language: 'ar',
            // menubar: 'insert',
            toolbar: 'undo redo | styleselect | bold underline italic | alignleft aligncenter alignright | media image link | forecolor backcolor | lists | emoticons',
            mobile: {
                theme: 'mobile',
                file_browser_callback: filemanager.tinyImgsVdsMceCallback,
                plugins: ['image', 'preview', 'media', 'lists', 'link', 'imagetools', 'contextmenu', 'print', 'table', 'textcolor', 'wordcount', 'directionality', 'fullscreen', 'visualblocks', 'autosave','emoticons'],
                toolbar: 'undo redo | styleselect | bold underline italic | alignleft aligncenter alignright | media image link | forecolor backcolor | lists | emoticons',
            },
            preview_styles: 'font-size color',
            directionality: 'rtl',
            branding: false,
            file_browser_callback: filemanager.tinyImgsVdsMceCallback,
            media_live_embeds: true,
            video_template_callback: function(data) {
                return '<video width="' + data.width + '" height="' + data.height + '"' + (data.poster ? ' poster="' + data.poster + '"' : '') + ' controls="controls">\n' + '<source src="' + data.source1 + '"' + (data.source1mime ? ' type="' + data.source1mime + '"' : '') + ' />\n' + (data.source2 ? '<source src="' + data.source2 + '"' + (data.source2mime ? ' type="' + data.source2mime + '"' : '') + ' />\n' : '') + '</video>';
            }
        });
    </script>
@endsection

