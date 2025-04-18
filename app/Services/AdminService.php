<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use App\Http\Resources\PostResource;
use App\Util\ResponseFormatter;
use App\Models\Post;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
//use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class AdminService 
{
    public function index(){
        $users = User::all();
        $posts = Post::all();

        return view('admin.index', [
            'users' => $users,
            'posts' => $posts
        ]);
        // return ResponseFormatter::success(
        //     "All Data:", 
        //     ["users" => $users, "posts" => $posts], 
        //     200
        // );
    }
    // public function index()
    // {
    //     $allUsers = collect();
    //     $tenants = Tenant::all(); // From central database
        
    //     foreach ($tenants as $tenant) {
    //         // Connect to each tenant database
    //         Config::set('database.connections.tenant.database', $tenant->database);
    //         DB::reconnect('tenant');
            
    //         // Get users from this tenant
    //         $tenantUsers = DB::connection('tenant')->table('users')->get();
            
    //         // Add tenant identifier to each user
    //         $tenantUsers->each(function($user) use ($tenant) {
    //             $user->tenant_name = $tenant->name;
    //         });
            
    //         // Merge with main collection
    //         $allUsers = $allUsers->merge($tenantUsers);
    //     }
        
    //     return $allUsers;
    // }
    
    // public function indhhhhex()
    // {
    //     $result = [];
    //     $tenants = Tenant::all(); // Get all tenants from central database
        
    //     foreach ($tenants as $tenant) {
    //         try {
    //             // Connect to the main database (not the tenant database)
    //             DB::connection('mysql'); // Use your central DB connection name
                
    //             // Drop the database/schema
    //             DB::statement("DROP DATABASE IF EXISTS `{$tenant->database}`");
                
    //             // Record success
    //             $result[] = [
    //                 'tenant' => $tenant->name,
    //                 'database' => $tenant->database,
    //                 'status' => 'dropped'
    //             ];
                
    //             // Optionally delete the tenant record from your central database
    //             // $tenant->delete();
    //         } catch (\Exception $e) {
    //             // Record failure
    //             $result[] = [
    //                 'tenant' => $tenant->name,
    //                 'database' => $tenant->database,
    //                 'status' => 'failed',
    //                 'error' => $e->getMessage()
    //             ];
    //         }
    //     }
        
    //     return $result;
    // }

    // public function getUserData(){
    //     $user = User::find(Auth::user()->id);
    //     return ResponseFormatter::success("User Data:", $user, 200);
    // }

    public function getPosts(){
        $posts = Post::with('user')->paginate(10);
        return view('admin.posts', [
            'posts' => $posts
        ]);
    }

    public function approve($userId)
    {
        $user = User::findOrFail($userId);
        $schema = 'tenant_' . Str::random(8);

        $tenant = Tenant::create([
            'name' => $user->firstname."-".$user->lastname. "'s Blog",
            'database' => $schema
        ]);

        $user->update([
            'status' => 'approved',
            'tenant_id' => $tenant->id
        ]);

        return back()->with('message', 'Tenant approved');
    }

    // public function createTenant($name)
    // {
    //     $schema = 'tenant_' . Str::random(8);
        
    //     // Create the schema
    //     DB::statement("CREATE SCHEMA IF NOT EXISTS `{$schema}`");
        
    //     // Run migrations in the new schema
    //     Artisan::call('tenants:migrate', [
    //         '--schema' => $schema
    //     ]);
        
    //     // Create tenant record
    //     return Tenant::create([
    //         'name' => $name,
    //         'database' => $schema
    //     ]);
    // }

}