<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Component
{
    public $permissions;
    public $roles;
    public $permissionName;
    public $selectedRole;
    public $selectedPermission;

    public function mount()
    {
        $this->permissions = Permission::all();
        $this->roles = Role::all();
    }

    public function createPermission()
    {
        Permission::create(['name' => $this->permissionName]);
        $this->permissionName = '';
        $this->mount();
    }

    public function deletePermission($id)
    {
        Permission::find($id)?->delete();
        $this->mount();
    }

    public function assignPermission()
    {
        if ($this->selectedRole && $this->selectedPermission) {
            $role = Role::findByName($this->selectedRole);
            $role->givePermissionTo($this->selectedPermission);
        }
        $this->mount();
    }

    public function removePermission($roleName, $permissionName)
    {
        $role = Role::findByName($roleName);
        $role->revokePermissionTo($permissionName);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.permissions', [
            'permissions' => Permission::all(),
            'roles' => Role::all(),
        ]);
    }
}
