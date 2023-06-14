<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Search for tags 
     */
    public function search(Request $request) {
        $query = $request->input('query');
        $except = $request->input('except');
        $querryCall = Tag::orderBy('name', 'asc');

        if (is_string($query) && trim($query) !== '') {
            $querryCall->where('name', 'like', '%'.$query.'%');
        } 

        if (is_array($except) && count($except) > 0) {
            $querryCall->whereNotIn('name', $except);
        }
        
        $tags = $querryCall->take(10)->get();
        return view('tags.search')->with('tags', $tags);
    }
}
