<?php

namespace App\Http\Livewire;

class DashboardSearch extends SearchComponent {

    public function render() {
        $searchResults = null;

        if (count(auth()->user()->posts) > 0) {
            $searchResults = auth()->user()->posts()
                ->search($this->search)
                ->orderBy('updated_at', 'DESC')
                ->paginate(15);
        }
        
        return view('search.dashboard')->with('searchResults', $searchResults);
    }
}
