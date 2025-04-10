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

class UserService 
{
    public function index(){
        $posts = Post::all();
        return view('welcome', compact('posts'));
    }

    public function create(){
        
    }
}