<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->postService->create();
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request)
    {
        return $this->postService->store($request);
    }

    public function getUserPosts(Request $request)
    {
        return $this->postService->getUserPosts();
    }

    public function update(Request $request, $id)
    {
        return $this->postService->update($request, $id);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        return $this->postService->destroy($id);
    }

    /**
     * Display the specified post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPostById(Request $request, $id)
    {
        return $this->postService->getPostById($id);
    }

    public function show($id)
    {
        return $this->postService->show($id);
    }

    public function deletePost($id)
    {
        return $this->postService->deletePost($id);
    }
}
