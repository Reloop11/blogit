@extends('layouts.app')

@section('content')
    <section class="section section-margin">
        <div class="form-card">
            <h2 class="form-title text-center">Create Post</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
                    
                    @error('title')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body" class="form-label">Body</label>
                    <textarea id="ckeditor" class="form-control @error('body') is-invalid @enderror" type="text" name="body" id="body" placeholder="Write something cool...">{{ old('body') }}</textarea>
                    
                    @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover-image" accept="image/*">
                    <small>Maximum Size: 2MB</small>
                    @error('cover_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Tags</label>
                    <div class="form-control tag-input-container border-bottom">
                        <div class="tag-container">
                            @if($tags = old('tags'))
                                @foreach($tags as $tag)
                                    <span class="tag">
                                        {{$tag}}
                                        <img class="tag-close" src="{{asset('images/icons/close.png')}}" alt="Remove">
                                        <input type="text" class="d-none" name="tags[]" value="{{$tag}}">
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        <input class="tag-input" type="text">
                        <div class="tag-dropdown dropdown-list"></div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit">{{__('Create')}}</button>
                    <a href="{{ route('home') }}" class="btn btn-danger post-discard">{{__('Discard')}}</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/forms/form.css?v'.time()) }}">
    <link rel="stylesheet" href="{{ asset('css/posts/form.css?v'.time()) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/forms/form.js') }}"></script>
    <script src="{{ asset('js/forms/ckeditor.js') }}"></script>
    <script src="{{ asset('js/posts/form.js') }}"></script>
@endpush