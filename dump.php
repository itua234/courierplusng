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