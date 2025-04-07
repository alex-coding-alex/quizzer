<?php

namespace App\Console\Commands;

use App\Enums\Role;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role as SpatieRole;

class PopulateRolesCommand extends Command
{
    protected $signature = 'populate:roles';

    protected $description = 'Populate the db with default roles';

    public function handle(): void
    {
        // Add all roles in the role enum to db
        foreach (Role::cases() as $role) {
            SpatieRole::firstOrCreate([
                'name' => $role->value,
            ]);
        }
    }
}
