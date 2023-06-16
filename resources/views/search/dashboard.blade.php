
<div class="d-flex flex-column">
    @livewireStyles

    @if($searchResults ?? null)
        <div class="d-flex justify-center">
            <div class="search-bar-container mb-2">
                <input id="search-bar" class="search-bar" type="text" wire:model="search" placeholder="Search for titles or keywords">
                <img class="d-none mr-2" wire:loading.class="visible" src="{{asset('images/icons/loading.gif')}}" alt="Loading...">
            </div>
        </div>

        @if(count($searchResults) > 0)
            <div class="d-flex justify-center flex-wrap">
                @foreach ($searchResults as $post)
                    <article wire:loading.class="opacity-50 disable-all" class="dashboard-post">
                        
                        <p class="text-dark flex-1">{{$post->title}}</p>
                        <div class="d-flex justify-center">
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary mr-2 text-center flex-1">{{__('Edit')}}</a>
                            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-post" type="submit">{{__('Delete')}}</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            {{ $searchResults->withQueryString()->links('pag.classic') }}
        @else
            <p class="text-dark text-center">Nothing found that match the search criteria</p>
        @endif
    @else
        <p class="text-dark text-center">No posts yet. <a class="text-nodeco text-primary text-bold" href="{{route('posts.create')}}">Let's change that</a></p>
    @endif

    @livewireScripts
</div>