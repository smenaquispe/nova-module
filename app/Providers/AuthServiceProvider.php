<?php

namespace App\Providers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Policies\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Permission::class => PermissionPolicy::class,
        Role::class => PermissionPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}