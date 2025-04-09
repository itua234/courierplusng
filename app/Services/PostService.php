<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use App\Http\Resources\PostResource;
use App\Util\ResponseFormatter;
use App\Models\Tenant;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class PostService 
{
    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('posts.create');
    }

    public function store($request)
    {
        return $request->all();
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }
}