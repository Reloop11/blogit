<?php

namespace App\Http\Livewire;

use App\Models\Post;

class PostsSearch extends SearchComponent
{
    public function render() {
        $searchResults = null;

        if (Post::count() > 0) {
            $searchResults = Post::search($this->search)
                ->orderBy('updated_at', 'DESC')
                ->paginate(15);
        }

        return view('search.posts')->with('searchResults', $searchResults);
    }
}
