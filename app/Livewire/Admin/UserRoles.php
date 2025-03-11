<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoles extends Component
{
    public $users;
    public $roles;
    public $selectedUser;
    public $selectedRole;

    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function assignRole()
    {
        $user = User::find($this->selectedUser);
        $user->assignRole($this->selectedRole);

        $this->selectedUser = null;
        $this->selectedRole = null;
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.user-roles');
    }
}
