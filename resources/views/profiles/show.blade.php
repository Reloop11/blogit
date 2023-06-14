@extends('layouts.app')

@section('content')
    <div class="w-100">
        <div class="profile-banner banner-container">
            <div class="banner banner-1 banner-left"></div>
            <div class="banner banner-2 banner-left"></div>
            <div id="profile-center-banner" class="banner banner-3 banner-center">
                <div class="profile-image-container banner-content">
                    <img class="profile-image" src="/storage/avatar_images/{{$profile->avatar}}" alt="Profile Image">
                </div>
                
                <h2 class="banner-text banner-content">
                    {{$profile->user->name}}
                    @auth
                    @if(auth()->user()->id == $profile->user->id)
                        <a class="justify-center" href="{{ route('profiles.edit', ['profile' => $profile->id]) }}"><img class="icon-btn" src="{{asset('/images/icons/edit.png')}}" alt="Edit"></a>
                    @endif
                @endauth
                </h2>
            </div>
            <div class="banner banner-2 banner-right"></div>
            <div class="banner banner-1 banner-right"></div>
        </div>
        <section class="section section-margin-x section-margin-bottom">
            <h2 class="text-center section-title">About {{$profile->user->name}}</h2>
            @if ($profile->hasInfo())
                <p>{!!$profile->bio!!}</p>
            @else
                <p class="text-dark text-center text-bold">The profile is empty</p>
            @endif
        </section>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/profiles/show.css?v'.time()) }}">
@endpush
