<div>
    <h2 class="text-2xl font-bold mb-4">Berechtigungen verwalten</h2>

    <!-- Neue Berechtigung erstellen -->
    <div class="mb-4">
        <h3 class="font-bold">Neue Berechtigung hinzufügen</h3>
        <input type="text" wire:model="permissionName" placeholder="Berechtigungsname"
               class="border rounded px-2 py-1 w-1/3">
        <button wire:click="createPermission" class="bg-green-500 text-white px-3 py-1 rounded">Hinzufügen</button>
    </div>

    <!-- Liste aller Berechtigungen -->
    <h3 class="font-bold">Bestehende Berechtigungen</h3>
    <table class="w-full border-collapse border border-gray-300 mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td class="border px-4 py-2">{{ $permission->name }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="deletePermission({{ $permission->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Löschen</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Berechtigungen einer Rolle zuweisen -->
    <h3 class="font-bold">Berechtigung einer Rolle zuweisen</h3>
    <div class="mb-4">
        <select wire:model="selectedRole" class="border rounded px-2 py-1">
            <option value="">Rolle wählen</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <select wire:model="selectedPermission" class="border rounded px-2 py-1">
            <option value="">Berechtigung wählen</option>
            @foreach($permissions as $permission)
                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
            @endforeach
        </select>

        <button wire:click="assignPermission" class="bg-blue-500 text-white px-3 py-1 rounded">Zuweisen</button>
    </div>

    <!-- Rollen und zugewiesene Berechtigungen anzeigen -->
    <h3 class="font-bold">Rollen und Berechtigungen</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">Rolle</th>
            <th class="border px-4 py-2">Berechtigungen</th>
            <th class="border px-4 py-2">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td class="border px-4 py-2">{{ $role->name }}</td>
                <td class="border px-4 py-2">
                    @foreach($role->permissions as $permission)
                        <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $permission->name }}</span>
                        <button wire:click="removePermission('{{ $role->name }}', '{{ $permission->name }}')" class="text-red-500">✖</button>
                    @endforeach
                </td>
                <td class="border px-4 py-2">
                    <button wire:click="removeRole({{ $role->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Löschen</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
