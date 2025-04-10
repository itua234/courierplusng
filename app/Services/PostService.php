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
        $user = auth()->user();
        $post = new Post();
        $post->title = $request->title;
        $post->user_id = $user->id;
        $post->tenant_id = $user->tenant_id;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        // Return a JSON response with the redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'redirect_url' => url('/'), // Replace with the desired redirect URL
        ]);
        //'redirect_url' => route('posts.show', $post->id),

        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function getUserPosts()
    {
        $user = auth()->user();
        $posts = Post::where('user_id', $user->id)->get();

        return ResponseFormatter::success('Posts retrieved successfully!', $posts);
    }

    public function getPostById($id)
    {
        $post = Post::findOrFail($id);

        return ResponseFormatter::success('Post data retrieved successfully!', $post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return ResponseFormatter::success('Post updated successfully!', $post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return ResponseFormatter::success('Post deleted successfully!', null);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully!');
    }
}