@extends('layouts.app')

@section('content')
    <section class="section section-margin">
        <div class="form-card">
            <h2 class="form-title text-center">Edit Profile</h2>
            <form action="{{ route('profiles.update', ['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Name" value="{{ old('name', $profile->user->name) }}">
                    
                    @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="avatar" class="form-label">Avatar @if($profile->avatar != 'no_image.png')&#40;{{__('Override')}}&#41;@endif</label>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar" accept="image/*">
                    <small>Maximum Size: 2MB</small>
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bio" class="form-label">About you</label>
                    <textarea id="ckeditor" class="form-control @error('bio') is-invalid @enderror" type="text" name="bio" id="bio" placeholder="How do you describe yourself...">{{ old('bio', $profile->bio) }}</textarea>
                    
                    @error('bio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit">{{__('Update')}}</button>
                    <a href="{{ route('profiles.show', ['profile' => $profile->id]) }}" class="btn btn-danger post-discard">{{__('Discard Changes')}}</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/forms/form.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/forms/form.js') }}"></script>
    <script src="{{ asset('js/forms/ckeditor.js') }}"></script>
@endpush