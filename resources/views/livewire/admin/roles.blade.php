<div>
    <h2>Rollen & Berechtigungen</h2>

    <div>
        <h3>Rollen erstellen</h3>
        <input type="text" wire:model="roleName">
        <button wire:click="createRole">Erstellen</button>
    </div>

    <div>
        <h3>Berechtigungen erstellen</h3>
        <input type="text" wire:model="permissionName">
        <button wire:click="createPermission">Erstellen</button>
    </div>

    <h3>Bestehende Rollen</h3>
    <ul>
        @foreach($roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>

    <h3>Bestehende Berechtigungen</h3>
    <ul>
        @foreach($permissions as $permission)
            <li>{{ $permission->name }}</li>
        @endforeach
    </ul>
</div>
