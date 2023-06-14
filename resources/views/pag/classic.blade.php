@if($paginator->hasPages())
    <div class="d-flex mt-2 mb-2">
        <div class="d-flex flex-1">
            <span class="text-dark mr-2">{{ __('Showing') }}</span>
            <span class="text-dark mr-2">{{ $paginator->firstItem() }}</span>
            <span class="text-dark mr-2">{{ __('to') }}</span>
            <span class="text-dark mr-2">{{ $paginator->lastItem() }}</span>
            <span class="text-dark mr-2">{{ __('of') }}</span>
            <span class="text-dark mr-2">{{ $paginator->total() }}</span>
            <span class="text-dark mr-2">{{ __('results') }}</span>
        </div>
        <div class="d-flex align-center">
            @if (!$paginator->onFirstPage())
                <img wire:click="previousPage" class="icon-btn" src="{{ asset('images/icons/prev.png') }}">
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <span wire:key="paginator-page{{ $page }}">
                            @if ($page == $paginator->currentPage())
                                <p class="paginator-page paginator-current">
                                    {{ $page }}
                                </p>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="paginator-page" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </button>
                            @endif
                        </span>
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <img wire:click="nextPage" class="icon-btn" src="{{ asset('images/icons/next.png') }}">
            @endif
        </div>
    </div>
@endif