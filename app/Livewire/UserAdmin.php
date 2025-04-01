<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\User;
use App\Models\UserSetting;

class UserAdmin extends Component
{
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public ?User $user = null;

    public function editUser($id = null)
    {
        if ($id) {
            $this->user = User::findOrFail($id);
        }
    }
    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }



    public function users(): Collection
    {
        return User::query()
           // ->with(['country'])
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->orderBy(...array_values($this->sortBy))
            ->get();
    }

    public function render()
    {

        if ($this->user) {
            return view('livewire.users.edit', ['user' => $this->user]);
        }
        return view('livewire.users.index', [
            'users' => $this->users(),
            'headers' => $this->headers()
        ]);
    }
}
