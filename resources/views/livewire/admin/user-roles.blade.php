<div>
    <h2>Benutzerrollen verwalten</h2>

    <select wire:model="selectedUser">
        <option value="">Benutzer auswählen</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <select wire:model="selectedRole">
        <option value="">Rolle auswählen</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endforeach
    </select>

    <button wire:click="assignRole">Rolle zuweisen</button>

    <h3>Benutzer und deren Rollen</h3>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - {{ implode(', ', $user->getRoleNames()->toArray()) }}</li>
        @endforeach
    </ul>
</div>
