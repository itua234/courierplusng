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
        $users = User::all();
        return ResponseFormatter::success("All Users:", $users, 200);
    }

    public function create(){
        
    }
}