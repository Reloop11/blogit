<div id="sidebar" class="sidebar sidebar-left">
    @auth
        <h3 class="text-dark text-center sidebar-title">{{auth()->user()->name}}</h3>
    @endauth

    <div class="sidebar-list">
        <a class="sidebar-item" href="{{ route('home') }}">{{__('Dashboard')}}</a>
        <a class="sidebar-item " href="{{ route('profiles.show', ['profile' => Auth::user()->profile->id]) }}">{{__('Profile')}}</a>

        <div class="sidebar-item sidebar-item-group">
            
        </div>
    </div>
</div>