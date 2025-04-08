<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{URL, DB, Auth};
use Illuminate\Support\Str;
//use App\Http\Resources\UserResource;
use App\Util\ResponseFormatter;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
//use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
//use Stancl\Tenancy\TenantManager;
use Illuminate\Support\Facades\Artisan;

class AuthService 
{
    protected $tokenName = 'user-token';

    // public function register($data){
    //     //create user
    //     $result =  DB::transaction(function() use($data){
    //         $user = User::create([
    //             'firstname' => sanitize_input($data['firstname']),
    //             'lastname' => sanitize_input($data['lastname']),
    //             'email' => sanitize_input($data['email']),
    //             'phone' => sanitize_input($data['phone']),
    //             'password' => sanitize_input($data['password']),
    //             'uuid' => Uuid::uuid4()->toString()
    //         ]);    

    //         $user->wallet()->create();
    //         $user->profile()->create();
            
    //         event(new Registered($user));

    //         Auth::login($user, true);

    //         return $user;
    //     });
    //     return redirect()->route('dashboard');
    // }
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
    public function register(array $data): Tenant
    {
        // Create a new tenant
        $tenant = Tenant::create([
            'name' => Str::slug($data['firstname'] . '-' . $data['lastname']) . '-' . Str::random(5).'.localhost', // Generate a unique, URL-safe name
            'database' => 'tenant_' . Str::random(8)
        ]);
        $schema = $tenant->database;
        // Create schema
        DB::statement("CREATE SCHEMA IF NOT EXISTS `{$schema}`");
        
        // Run migrations in the new schema
        Artisan::call('tenants:migrate', [
            '--schema' => $schema
        ]);
        
        // Create user
        DB::connection('tenant')->table('users')->insert([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
            'tenant_id' => $tenant->id
        ]);

        return $tenant;
    }

    // public function login($data){
    //     $user = User::where(['email' => $data['email']])->first();

    //     if(!$user || !password_verify($data["password"], $user->password)):
    //         $message = "Oops, your email or password is incorrect";
    //         return ResponseFormatter::error($message, 400);
       
    //     endif;
        
    //     //delete user previous token ....single device auth only
    //     $this->deleteToken($user);
    //     $user->refresh();
        
    //     //Auth::guard("web")->login($user, true);
        
    //     Auth::login($user, true);
    //     $user = Auth::user();
    //     $token = $this->generateToken($user);
    //     $user->token = $token;

    //     unset($user->tokens);
    //     return redirect()->route('dashboard');
        
        

    //     // $message = 'Login successfully';
    //     // return ResponseFormatter::success(
    //     //     $message, 
    //     //     ["user" => $user, "redirect" => url('')]
    //     // );
    // }

    public static function login($request){
        if(Auth::attempt([
            'email'=>sanitize_input($request->email), 
            'password'=>sanitize_input($request->password)
        ], true)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        Session(['msg'=>'Invalid Login Credentials', 'alert'=>'danger']);
        return redirect()->back();
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