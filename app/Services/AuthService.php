<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{URL, DB, Auth};
use Illuminate\Support\Str;
use App\Util\ResponseFormatter;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class AuthService 
{
    protected $tokenName = 'user-token';

    /**
     * Register a new tenant and create their database schema
     *
     * @param  array  $data  [
     *     'firstname' => string,
     *     'lastname' => string,
     *     'email' => string,
     *     'password' => string
     * ]
     * @return \App\Models\Tenant
     * @throws \Throwable
    */
    // public function register(array $data): Tenant
    // {
    //     // Create a new tenant
    //     $tenant = Tenant::create([
    //         'name' => Str::slug($data['firstname'] . '-' . $data['lastname']) . '-' . Str::random(5).'.localhost', // Generate a unique, URL-safe name
    //         'database' => 'tenant_' . Str::random(8)
    //     ]);
    //     $schema = $tenant->database;
    //     // Create schema
    //     DB::statement("CREATE SCHEMA IF NOT EXISTS `{$schema}`");
        
    //     // Run migrations in the new schema
    //     Artisan::call('tenants:migrate', [
    //         '--schema' => $schema
    //     ]);
        
    //     // Create user
    //     DB::connection('tenant')->table('users')->insert([
    //         'firstname' => $data['firstname'],
    //         'lastname' => $data['lastname'],
    //         'email' => $data['email'],
    //         'email_verified_at' => now(),
    //         'password' => Hash::make($data['password']),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //         'tenant_id' => $tenant->id
    //     ]);

    //     return $tenant;
    // }

    public function register (array $data){
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => $data['password']
        ]);

        Auth::login($user, true);
        return redirect('/')->with('success', 'Registration successful!');
    }

    public static function login($request){
        if(Auth::attempt([
            'email'=> $request->email,
            'password'=> $request->password
        ], true)){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login successful!');
        }
        Session(['msg'=>'Invalid Login Credentials', 'alert'=>'danger']);
        return redirect()->back();
    }

    public function logOut(Request $request)
    {
        //delete all previous user token
        $this->deleteToken(auth()->user());

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/")->with('success', 'Logout successful!');
    }

    private function generateToken($user)
    {
        return $user->createToken($this->tokenName)->plainTextToken;
    }

    private function deleteToken($user): void
    {
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });
    }
    
}