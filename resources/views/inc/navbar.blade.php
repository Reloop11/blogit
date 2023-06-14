<nav class="navbar shadow-small">
    <div class="navbar-container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Blog<span class="name-accent">it</span>
        </a>
        
        <div class="navbar-nav">
            <a href="{{ route('home') }}" class="nav-item nav-link">{{__('Home')}}</a>
            {{-- <a href="{{ route('about') }}" class="nav-item nav-link">{{__('About')}}</a> --}}
            <a href="{{ route('posts.index') }}" class="nav-item nav-link">{{__('Blog')}}</a>
        </div>

        <div class="navbar-nav justify-right">
            @guest
                @if (Route::has('login'))
                    <a class="nav-item nav-link" href="{{ route('login') }}">{{__('Login')}}</a>
                @endif

                @if (Route::has('register'))
                    <a class="nav-item nav-link" href="{{ route('register') }}">{{__('Register')}}</a>
                @endif
            @else
                <a href="{{ url('/posts/create') }}" class="nav-item nav-link">Create Post</a>
                <div class="nav-item dropdown">
                    <a id="user-dropdown" class="nav-link dropdown-toggle" href="#" role="button">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profiles.show', ['profile' => Auth::user()->profile->id]) }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>