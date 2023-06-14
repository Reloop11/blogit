
<div class="d-flex flex-column">
    @livewireStyles

    @if($searchResults ?? null)
        <div class="d-flex justify-center">
            <div class="search-bar-container mb-2">
                <input id="search-bar" class="search-bar" type="text" wire:model.debounce.500ms="search" placeholder="Search for titles or keywords">
                <img class="d-none mr-2" wire:loading.class="visible" src="{{asset('images/icons/loading.gif')}}" alt="Loading...">
            </div>
        </div>

        @if(count($searchResults) > 0)
            <div class="d-flex justify-center flex-wrap">
                @foreach ($searchResults as $post)
                    <article wire:loading.class="opacity-50 disable-all" class="post-card-container post-link-container">
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

            {{ $searchResults->withQueryString()->links('pag.classic') }}
        @else
            <p class="text-dark text-center">Nothing found that match the search criteria</p>
        @endif
    @else
        <p class="text-dark text-center">There is no posts :&#40;</p>
    @endif

    @livewireScripts
</div>