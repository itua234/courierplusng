<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{
    private AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index(){
        return $this->adminService->index();
    }

    public function getUser(){
        return $this->adminService->getUserData();
    }

    public function getPostData($postId){
        return $this->adminService->getPostData($postId);
    }

    public function approveUser($userId){
        return $this->adminService->approve($userId);
    }

    public function createTenant(Request $request){
        $name = "itua-blog";
        return $this->adminService->createTenant($name);
    }
}
