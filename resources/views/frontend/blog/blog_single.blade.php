{{-- @section('title', $title) --}}

@extends('frontend.layouts.master')

@section('content')
    <div class="breadcrumbarea">

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__content__wraper aos-init " data-aos="fade-up">
                        <div class="breadcrumb__title">
                            <h2 class="heading">{{ $title }}</h2>
                        </div>
                        <div class="breadcrumb__inner">
                            <ul>
                                <li><a href="/">{{ __('Home') }}</a></li>
                                <li><a href="{{ route('blog') }}">{{ __('Blog') }}</a></li>
                                <li>{{ $title }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape__icon__2">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__1" src="{{ asset('frontend/img/herobanner__1.png') }}" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__2" src="{{ asset('frontend/img/herobanner__2.png') }}" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__3" src="{{ asset('frontend/img/herobanner__3.png') }}" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__4" src="{{ asset('frontend/img/herobanner__5.png') }}" alt="photo">
        </div>

    </div>

    <div class="blogarea__2 sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">

                    <div class="blog__details__content__wraper">
                        <div class="blog__details__img aos-init" data-aos="fade-up">
                            <img loading="lazy" src="{{ $post->thumbSrc() }}" alt="blog">
                        </div>
                        <div class="blog__details__content">
                            {!! $post->content !!}
                        </div>
                        <div class="blog__details__tag aos-init aos-animate" data-aos="fade-up">
                            <ul>
                                <li class="heading__tag">
                                    {{ __('Categories') }}
                                </li>
                                @foreach ($post->categories as $cat)
                                    <li>
                                        <a href="#">{{ $cat->parent->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="share__list aos-init aos-animate" data-aos="fade-up">
                                <li class="heading__tag">
                                    {{ __('Share') }}
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ route('blog_single', $post->slug) }}" target="_blank"><i class="icofont-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog_single', $post->slug) }}" target="_blank"><i class="icofont-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/?url={{ route('blog_single', $post->slug) }}" target="_blank"><i class="icofont-instagram"></i></a>
                                </li>
                            </ul>
                        </div>

                        @livewire('components.blog-comments', [$post->slug])

                    </div>

                </div>


                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="blogsidebar__content__wraper__2 aos-init aos-animate" data-aos="fade-up">
                        <div class="blogsidebar__content__inner__2">
                            <div class="blogsidebar__img__2">
                                <img class="rounded-circle" loading="lazy" src="{{ $post->user->profile_photo_url }}" alt="blog" style="max-width: 100px">
                            </div>
                            <div class="blogsidebar__name__2">
                                <h5>
                                    <a href="#"> {{ $post->user->name }}</a>

                                </h5>
                                <p>
                                    @foreach ($post->user->roles as $role)
                                        {{ $role->display_name }}/
                                    @endforeach
                                </p>
                            </div>
                            <div class="blog__sidebar__text__2">
                                <p>{{ $post->user->bio }}</p>
                            </div>
                            <div class="blogsidbar__icon__2">
                                <ul>
                                    <li>
                                        <a href="{{Auth::user()->data['facebook'] ?? 'javascript:viod(0)'}}"><i class="icofont-facebook"></i></a>
                                    </li>

                                    <li>
                                        <a href="{{Auth::user()->data['youtube'] ?? 'javascript:viod(0)'}}"><i class="icofont-youtube-play"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{Auth::user()->data['instagram'] ?? 'javascript:viod(0)'}}"><i class="icofont-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{Auth::user()->data['twitter'] ?? 'javascript:viod(0)'}}"><i class="icofont-twitter"></i></a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    @livewire('components.blog-sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection