@extends('layouts.app')

@section('content')
<section class="d-flex flex-column justify-center align-center flex-1 section-margin">
    <div class="card-container">
        <h3 class="text-dark text-center from-title">{{ __('Login') }}</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-container">
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>

                    <div class="d-flex flex-column">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>

                    <div class="d-flex flex-column">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group mb-0 pb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/forms/form.css?v'.time()) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/forms/form.js') }}"></script>
@endpush