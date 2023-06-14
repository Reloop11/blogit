@extends('layouts.app')

@section('content')
    <div class="w-100">
        <section class="section section-margin">
            <h2 class="section-title text-center mt-0">Latest Posts</h2>
            @livewire('search.posts')
        </section>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/post.css?v'.time()) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/posts/post.js?v'.time()) }}"></script>
@endpush