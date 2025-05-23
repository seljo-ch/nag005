<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\AssignRoleAfterLogin;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            AssignRoleAfterLogin::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
