//     // Override the create method to handle 'name' and 'database'
//     protected static function booted()
//     {
//         static::creating(function ($tenant) {
//             // Ensure 'data' is initialized as an array
//             $tenant->data = array_merge($tenant->data ?? [], [
//                 'name' => $tenant->getOriginal('name') ?? null,
//                 'database' => $tenant->getOriginal('database') ?? null,
//             ]);
//         });
//     }

//     public function database(): DatabaseConfig
//     {
//         $databaseName = $this->data['database'] ?? 'tenant_' . $this->id;

//         return new DatabaseConfig(
//             name: $databaseName,
//             user: env('DB_USERNAME', 'root'),
//             password: env('DB_PASSWORD', ''),
//             host: env('DB_HOST', '127.0.0.1'),
//             port: env('DB_PORT', '3306')
//         );
//     }
    
//    // Accessor for the 'database' attribute
//    public function getDatabaseAttribute()
//    {
//        return $this->data['database'] ?? null;
//    }
//    // Mutator for the 'database' attribute
//    public function setDatabaseAttribute($value)
//    {
//        $this->data = array_merge($this->data ?? [], ['database' => $value]);
//    }

//    // Accessor for the 'name' attribute
//    public function getNameAttribute()
//    {
//        return $this->data['name'] ?? null;
//    }
//     // Mutator for the 'name' attribute 
//     public function setNameAttribute($value)
//     {
//         $this->data = array_merge($this->data ?? [], ['name' => $value]);
//     }


$tenant1 = App\Models\Tenant::create([
    'data' => [
        'name' => 'foo',
        'database' => 'tenant1',
    ],
]);
$tenant1->domains()->create(['domain' => 'foo.localhost']);


$tenant2 = App\Models\Tenant::create([
    'data' => [
        'name' => 'bar',
        'database' => 'tenant2',
    ],
]);
$tenant2->domains()->create(['domain' => 'bar.localhost']);




namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\TenantManager;

class TenantRegistrationController extends Controller
{
    public function register(Request $request)
    {
        // Step 1: Validate the request
        $validated = $request->validate([
            'tenant_name' => 'required|string|max:255|unique:tenants,data->name',
            'domain' => 'required|string|unique:domains,domain',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Step 2: Create the tenant
        $tenant = Tenant::create([
            'id' => uniqid(), // Generate a unique tenant ID
            'data' => [
                'name' => $validated['tenant_name'],
            ],
        ]);

        // Step 3: Create the tenant's database
        $tenant->createDatabase();

        // Step 4: Associate a domain with the tenant
        $tenant->domains()->create(['domain' => $validated['domain']]);

        // Step 5: Run the tenant's database connection
        tenancy()->initialize($tenant);

        // Step 6: Create the user in the tenant's database
        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Step 7: Return a success response
        return response()->json([
            'message' => 'Tenant and user created successfully!',
            'tenant' => $tenant,
            'user' => $user,
        ]);
    }
}


public function approveUser(User $user)
{
    $tenant = Tenant::create([
        'name' => $user->name . "'s Blog",
        'domain' => strtolower(str_replace(' ', '-', $user->name)) . '.myblog.com',
    ]);

    $user->update([
        'status' => 'approved',
        'tenant_id' => $tenant->id,
    ]);
}

@foreach($pendingTenants as $tenant)
    <div class="tenant-request">
        <h3>{{ $tenant->name }}</h3>
        <p>Requested by: {{ $tenant->user->email }}</p>
        <div class="actions">
            <form action="{{ route('admin.tenants.approve', $tenant) }}" method="POST">
                @csrf
                <button type="submit">Approve</button>
            </form>
            <form action="{{ route('admin.tenants.reject', $tenant) }}" method="POST">
                @csrf
                <input type="text" name="reason" placeholder="Rejection reason">
                <button type="submit">Reject</button>
            </form>
        </div>
    </div>
@endforeach
