<?php

namespace App\Listeners;

use IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Spatie\Permission\Models\Role;

class AssignRoleAfterLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;

        // Falls der User noch keine Rolle hat, Standardrolle setzen
        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }
    }
}
