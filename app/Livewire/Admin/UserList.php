<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUser;
    public $selectedRole;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function assignRole()
    {
        if ($this->selectedUser && $this->selectedRole) {
            $user = User::find($this->selectedUser);
            $user->assignRole($this->selectedRole);
        }
    }

    public function removeRole($userId, $roleName)
    {
        $user = User::find($userId);
        $user->removeRole($roleName);
    }

    public function deleteUser($userId)
    {
        User::find($userId)?->delete();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.user-list', [
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }
}
