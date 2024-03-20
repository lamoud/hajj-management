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
                                <li><a href="index.html">{{ __('Home') }}</a></li>
                                <li>{{$title }}</li>
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

                    @forelse ($posts as $post)
                        <div class="blog__content__wraper__2 aos-init " data-aos="fade-up">
                            <div class="blogarae__img__2">
                                <img loading="lazy" src="{{ $post->thumbSrc() }}" alt="blog">
                                <div class="blogarea__date__2">
                                    <span>{{ get_day($post->created_at) }}</span>
                                    <span class="blogarea__month">{{ get_month($post->created_at) }}</span>
                                </div>
                            </div>
                            <div class="blogarea__text__wraper__2">
                                <div class="blogarea__heading__2">
                                    <h3><a href="{{ route('blog_single', $post->slug) }}">{{ $post->title }}</a></h3>
                                </div>
                                <div class="blogarea__list__2">
                                    <ul>
                                        <li>
                                            <a href="{{ route('user_profile', $post->user->email) }}">
                                                <i class="icofont-business-man-alt-2"></i> {{ $post->user->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="icofont-speech-comments"></i> {{ count($post->comments) .' '. __('Comment') }}
                                            </a>
                                        </li>

                                        <li>
                                            @if ( count($post->categories) )
                                                <a href="javascript:void(0)">
                                                    <i class="icofont-eraser-alt"></i> {{ $post->categories[0]->parent->title }}
                                                </a>
                                            @endif
                                        </li>

                                    </ul>
                                </div>
                                <div class="blogarea__paragraph">
                                    <p>{{ get_words( $post->content, 25) }}</p>
                                </div>
                                <div class="blogarea__button__2">
                                    <a href="{{ route('blog_single', $post->slug) }}">{{ __('READ MORE') }}
                                        <i class="icofont-double-{{ App::getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                                    </a>
                                </div>
                            </div>


                        </div>
                    @empty
                        {{ __('No data') }}
                    @endforelse

                    <div class="row justify-content-center aos-init" data-aos="fade-up">
                        {{ $posts->links("pagination::bootstrap-5") }}
                    </div>


                </div>


                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    @livewire('components.blog-sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection