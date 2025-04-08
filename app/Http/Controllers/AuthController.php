<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $data = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123'
        ];
        $request = new Request();
        $request->merge($data);
        // $data = $request->validate([
        //     'firstname' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'phone' => 'required|string|max:15',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        return $this->authService->register($request->all());
    }

    public function createTenant(Request $request){
        $name = "itua-blog";
        return $this->adminService->createTenant($name);
    }
}
