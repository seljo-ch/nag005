<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{
    public $roles;
    public $permissions;
    public $roleName;
    public $permissionName;

    public function mount()
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function createRole()
    {
        Role::create(['name' => $this->roleName]);
        $this->roleName = '';
        $this->mount();
    }

    public function createPermission()
    {
        Permission::create(['name' => $this->permissionName]);
        $this->permissionName = '';
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.roles');
    }
}
