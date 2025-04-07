<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TenantsMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:tenants-migrate-command';
    //protected $signature = 'tenants:migrate {--schema=}';
    protected $signature = 'tenants:migrate 
    {--schema= : The name of the tenant schema}
    {--fresh : Drop all tables and re-run all migrations}
    {--seed : Seed the database after migration}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for a specific tenant schema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schema = $this->option('schema');
        if (!$schema) {
            $this->error('Schema name is required');
            return 1;
        }
    
        // Configure the tenant database connection
        $this->configureTenantConnection($schema);
        
        // Run migrations
        $this->runMigrations();

        // Optionally seed
        if ($this->option('seed')) {
            $this->runSeeder();
        }
        
        $this->info("Migrations completed for tenant: {$schema}");
        return 0;
    }

    protected function configureTenantConnection($schema)
    {
        DB::purge('tenant');
        config()->set('database.connections.tenant.database', $schema);
        DB::reconnect('tenant');
    }

    protected function runMigrations()
    {
        $options = [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ];
        
        if ($this->option('fresh')) {
            $this->call('migrate:fresh', $options);
        } else {
            $this->call('migrate', $options);
        }
    }

    protected function runSeeder()
    {
        $this->call('db:seed', [
            '--database' => 'tenant',
            //'--class' => 'TenantDatabaseSeeder'
        ]);
    }
}
