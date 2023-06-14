@extends('layouts.app')

@section('content')
    <section class="section-margin">
        <div class="post">
            @if($post->cover_image !== 'no_image.jpg')
                <div class="post-cover-container">
                    <img class="post-cover" src="/storage/cover_images/{{$post->cover_image}}" alt="Cover Image">
                </div>
            @endif
            <div class="d-flex align-center">
                <h2 class="text-dark mb-1">{{$post->title}}</h2>
                @auth
                    @if(auth()->user()->id !== $post->user_id)
                        <p class="ml-4 fit">by <a class="text-primary text-bold text-nodeco" href="{{ route('profiles.show', ['profile' => $post->user->profile->id]) }}">{{$post->user->name}}</a></p>
                        <p class="text-dark flex-1 text-right fit ml-4">{{$post->updated_at->format('M / d / Y')}}</p>
                    @else
                        <div class="d-flex justify-right flex-1">
                            <a href="{{ route('posts.edit', ['post' => $post->id])}}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('posts.destroy', ['post' => $post->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger post-delete" type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                @else
                    <p class="ml-2">by <a class="text-primary text-bold text-nodeco" href="{{ route('profiles.show', ['profile' => $post->user->profile->id]) }}">{{$post->user->name}}</a></p>
                    <small class="text-dark">{{$post->updated_at->format('M / d / Y')}}</small>
                @endauth
            </div>
            {{-- @if(count($post->tags) > 0)
                <div class="d-flex align-center mb-2">
                    <p class="text-dark text-bold flex-shrink mr-2">Tags:</p>
                    @foreach($post->tags as $tag)
                        <a class="post-tag" href="{{ route('posts.search', ['query' => 'tag:'.$tag->name]) }}">{{$tag->name}}</a>
                    @endforeach
                </div>
            @endif --}}
            {!!$post->body!!}
        </div>
    </section>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/show.css?v'.time()) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/posts/show.js') }}"></script>
@endpush