<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use TagValidator;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show', 'search']);
        $this->middleware('sanitize', ['htmlInputs' => ['body']])->only(['store', 'update']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        
        foreach($posts as &$post) {
            // Decode post special characters
            $post = decodePost($post);
        }

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $postData = $this->validateRequest($request);
        $tags = $request->input('tags');

        if (is_array($tags) && count($tags) > 0) {
            $tags = TagValidator::validate($tags);
        } else {
            $tags = []; // Reset to empty array
        }
        
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $coverExt = $image->getClientOriginalExtension();
            $coverName = 'IMG_'.time().'.'.$coverExt;

            storeUploadedImage($image, $coverName, '/public/cover_images');
            $postData['cover_image'] = $coverName;
        } else {
            // Delete cover_image since it has a default value
            unset($postData['cover_image']);
        }
        
        // Set the missing inputs
        $postData['user_id'] = auth()->user()->id;

        // Create a new post
        $post = Post::create($postData);
        $post->tags()->sync(array_map(function($tag) {
            return $tag->id;
        }, $tags));

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $post = Post::findOrFail($id);
        
        // Check for the correct user
        if ($post->user->id !== auth()->user()->id) {
            abort(401);
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $post = Post::findOrFail($id);
        $postData = $this->validateRequest($request);
        $tags = $request->input('tags');

        // Check for the correct user
        if ($post->user->id !== auth()->user()->id) {
            abort(401);
        }

        if (is_array($tags) && count($tags) > 0) {
            $tags = TagValidator::validate($tags);
        } else {
            $tags = []; // Reset to empty array
        }

        if ($request->hasFile('cover_image')) {
            $oldImage = ($post->cover_image !== 'no_image.jpg') ? $post->cover_image : null;
            $image = $request->file('cover_image');
            $coverExt = $image->getClientOriginalExtension();
            $coverName = 'IMG_'.time().'.'.$coverExt;

            storeUploadedImage($image, $coverName, '/public/cover_images', $oldImage);
            $postData['cover_image'] = $coverName;
        } else {
            // Delete the cover_image field from the data because is a file
            unset($postData['cover_image']);
        }

        // Update the data of the post
        $post->update($postData);
        $post->tags()->sync(array_map(function($tag) {
            return $tag->id;
        }, $tags));

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $post = Post::findOrFail($id);
        
        // Check for the correct user
        if ($post->user->id !== auth()->user()->id) {
            abort(401);
        }

        // Delete the cover_image if exists
        $oldImage = $post->cover_image;
        if ($oldImage !== 'no_image.jpg') {
            Storage::delete('/public/cover_images/'.$oldImage);
        }
        
        // Delete the post
        $post->tags()->detach();
        $post->delete();
        return redirect('/')->with('success', __('messages.post_deleted'));
    }

    /**
     * Post Search
     */
    public function searchOld(Request $request) {
        $query = $request->query('query');
        $posts = Post::orderBy('updated_at', 'desc');

        if (is_string($query) && trim($query) !== '') {
            $keywords = explode(' ', $query);
            $keywords = array_map('trim', $keywords);
            $keywords = array_filter($keywords);
            
            $tags = [];
            $prefix = 'tag:';
            $prefixLength = strlen($prefix);

            foreach($keywords as $index => $key) {
                if (str_starts_with($key, $prefix)) {
                    $tags[] = substr($key, $prefixLength);
                    unset($keywords[$index]);
                }
            }
            
            if (count($keywords) > 0) {
                $posts->where(function($queryBuilder) use ($keywords) {
                    foreach($keywords as $key) {
                        $queryBuilder->orWhere('title', 'LIKE', '%'.$key.'%');
                    }
                });
            }
    
            if (count($tags) > 0) {
                $posts->whereHas('tags', function($queryBuilder) use ($tags) {
                    foreach($tags as $tag) {
                        $queryBuilder->where('name', 'LIKE', '%'.$tag.'%');
                    }
                });
            } else {
                $posts->orWhereHas('tags', function($queryBuilder) use ($keywords) {
                    foreach($keywords as $key) {
                        $queryBuilder->where('name', 'LIKE', '%'.$key.'%');
                    }
                });
            }
        }

        $paginated = $posts->paginate(20);
        return view('posts.search')->with('posts', $paginated)->with('query', $query);
    }

    /**
     * Validate user form input
     */
    protected function validateRequest(Request $request) {
        return $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'cover_image' => ['image', 'nullable', 'max:2048']
        ]);
    }

    
}
