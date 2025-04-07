<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\TenantsMigrateCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('tenants:migrate {--schema=} {--fresh} {--seed}', function () {
    $schema = $this->argument('schema');
    $fresh = $this->argument('fresh');
    $seed = $this->argument('seed');
    
    // Create an instance of TenantsMigrateCommand
    $command = new TenantsMigrateCommand();
    // Call the handle method with the options
    $command->handle($schema, $fresh, $seed);
    $this->info("Migrations completed for tenant: {$schema}");
})->purpose('Run migrations for a specific tenant schema');