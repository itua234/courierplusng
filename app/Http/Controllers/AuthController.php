<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showSignupForm(): View
    {
        return view('auth.register');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Register a new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        return $this->authService->register($request->validated());
    }

    public function createTenant(Request $request){
        $name = "itua-blog";
        return $this->adminService->createTenant($name);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}
