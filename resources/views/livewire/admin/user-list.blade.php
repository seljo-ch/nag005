<div>
    <h2 class="text-2xl font-bold mb-4">Benutzerverwaltung</h2>

    <!-- Suchfeld -->
    <input type="text" wire:model.debounce.300ms="search" placeholder="Suche nach Name oder E-Mail"
           class="border rounded px-2 py-1 mb-3 w-full">

    <!-- Benutzerliste -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">E-Mail</th>
            <th class="border px-4 py-2">Rollen</th>
            <th class="border px-4 py-2">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">
                    @foreach($user->roles as $role)
                        <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $role->name }}</span>
                        <button wire:click="removeRole({{ $user->id }}, '{{ $role->name }}')" class="text-red-500">✖</button>
                    @endforeach
                </td>
                <td class="border px-4 py-2">
                    <button wire:click="deleteUser({{ $user->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Löschen</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Paginierung -->
    <div class="mt-3">
        {{ $users->links() }}
    </div>

    <!-- Rolle zuweisen -->
    <h3 class="mt-5 text-xl font-bold">Rolle zuweisen</h3>
    <select wire:model="selectedUser" class="border rounded px-2 py-1">
        <option value="">Benutzer wählen</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <select wire:model="selectedRole" class="border rounded px-2 py-1">
        <option value="">Rolle wählen</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endforeach
    </select>

    <button wire:click="assignRole" class="bg-green-500 text-white px-2 py-1 rounded">Zuweisen</button>
</div>
