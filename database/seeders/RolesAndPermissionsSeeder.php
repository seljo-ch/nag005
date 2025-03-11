<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Berechtigungen definieren
        $permissions = [
            'create_note',
            'view_note',
            'view_note-alluser',
            'func_send-sms',
            'func_db-sync',
            'func_db-sync-protocol',
            'func_restart-reporting',
            'view_user',
            'view_role',
            'view_permission',
            'edit_user',
            'edit_role',
            'edit_permission',
        ];

        // Berechtigungen erstellen (falls nicht existieren)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Standard-Rollen erstellen
        $roles = [
            'user' => ['create_note', 'view_note'],
            'admin' => Permission::pluck('name')->toArray(), // Alle Berechtigungen
            'avor' => ['func_db-sync', 'func_db-sync-protocol', 'func_restart-reporting'],
            'dispo' => ['func_send-sms'],
        ];

        // Rollen und Berechtigungen zuweisen
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
// Standard User erstellen (falls nicht existiert)
        $adminEmail = 'it@nyffenegger.ch'; // Hier deine Standard-Admin-Mail setzen

        $admin = User::firstOrCreate([
            'email' => $adminEmail,
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password123'), // Ändere das Passwort nach Bedarf!
        ]);

        // Admin zur "superadmin"-Rolle hinzufügen
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
        // Standard Admin User erstellen (falls nicht existiert)
        $userEmail = 'user@nyffenegger.ch'; // Hier deine Standard-Admin-Mail setzen

        $user = User::firstOrCreate([
            'email' => $userEmail,
        ], [
            'name' => 'User',
            'password' => Hash::make('password123'), // Ändere das Passwort nach Bedarf!
        ]);

        // Admin zur "superadmin"-Rolle hinzufügen
        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

    }
}
