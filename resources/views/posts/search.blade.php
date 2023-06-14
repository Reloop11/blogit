@extends('layouts.app')

@section('content')
    <div class="w-100">
        <section class="section section-margin-x align-center">
            @include('inc.search')
            @if(count($posts) > 0)
                <div class="d-flex flex-wrap justify-center">
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
                </div>
                <div class="w-100">
                    {{ $posts->withQueryString()->links('pag.classic') }}
                </div>
            @else
                <p class="text-center">{{__('We can\'t find any post that matches the search')}}</p>
            @endif
        </section>
    </div>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/post.css?v'.time()) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/posts/post.js?v'.time()) }}"></script>
@endpush