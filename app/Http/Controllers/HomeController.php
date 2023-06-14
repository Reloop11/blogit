<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = [];
        if (auth()->check()) {
            $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $posts = Post::orderBy('created_at', 'desc')->take(12)->get();
        }
        
        return view('pages.home')->with('posts', $posts);
    }
}
