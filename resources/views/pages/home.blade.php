@extends('layouts.app')

@section('content')
    <div class="w-100">
        @guest
            <div class="home-banner banner-container">
                <div class="banner banner-1 banner-left"></div>
                <div class="banner banner-2 banner-left"></div>
                <div id="home-center-banner" class="banner banner-3 banner-center">
                    <h1 class="banner-text banner-content">Welcome to Blogit!</h1>
                    <p class="banner-text banner-content">Discover insightful and engaging blog posts on a wide range of topics</p>
                </div>
                <div class="banner banner-2 banner-right"></div>
                <div class="banner banner-1 banner-right"></div>
            </div>
            <section class="section section-margin align-center">
                <div class="card-container">
                    <h2>Just blog<span class="name-accent">it</span></h2>
                    <p>Login or Register to create your own blogs and share your histories with other people</p>
                    <div class="d-flex align-center">
                        <a class="btn btn-primary mr-2" href="{{ route('login') }}">Login</a>
                        <a class="link" href="{{ route('register') }}">Register</a>
                    </div>
                </div>
            </section>
            <section class="section section-margin-x section-margin-bottom">
                <h2 class="section-title text-center mb-6">Latest Posts</h2>
                <div class="d-flex flex-wrap justify-center">
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <article class="post-card-container post-link-container">
                                <div class="post-card-image-container">
                                    <img class="post-card-image" src="/storage/cover_images/{{$post->cover_image}}" alt="Cover Image">
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <a class="link-header post-link text-ellipsis" href="{{ url('/posts/'.$post->id) }}">{{$post->title}}</a>
                                    <small class="text-dark">by {{$post->user->name}}</small>
                                    @if(count($post->tags) > 0)
                                        <div class="post-tag-container">
                                            @foreach($post->tags as $tag)
                                                <span class="post-tag">{{$tag->name}}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p class="text-center">{{__('This is weird... There is no posts :(')}}</p>
                    @endif
                </div>
            </section>
        @else
            <div class="banner-container content-banner">
                <div class="banner banner-1 banner-left"></div>
                <div class="banner banner-2 banner-left"></div>
                <div id="content-center-banner" class="banner banner-3 banner-center">
                    <h2 class="banner-text banner-content">{{__('Dashboard')}}</h2>
                </div>
                <div class="banner banner-2 banner-right"></div>
                <div class="banner banner-1 banner-right"></div>
            </div>
            <section class="section section-margin-x">
                <div class="d-flex flex-column">
                    <h2 class="text-dark text-center section-title">{{__('Your Posts')}}</h2>
                    @livewire('search.dashboard')
                </div>
            </section>
        @endguest
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css?v'.time()) }}">
    <link rel="stylesheet" href="{{ asset('css/posts/post.css?v'.time()) }}">
@endpush

@push('scripts')
        <script src="{{ asset('js/pages/home.js?v'.time()) }}"></script>
    <script src="{{ asset('js/posts/post.js') }}"></script>
@endpush