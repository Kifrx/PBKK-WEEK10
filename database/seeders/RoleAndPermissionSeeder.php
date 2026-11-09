<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = ['lihat-data', 'tambah-data', 'edit-data', 'hapus-data'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach (['admin' => 'Administrator Akademik', 'staf' => 'Staf Akademik'] as $roleName => $name) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($roleName === 'admin' ? $permissions : array_diff($permissions, ['hapus-data']));

            $user = User::firstOrCreate(
                ['email' => $roleName.'@its.ac.id'],
                ['name' => $name, 'password' => Hash::make('password')],
            );

            if ($user->wasRecentlyCreated) {
                $user->assignRole($role);
            } elseif (! $user->hasRole($role)) {
                throw new RuntimeException("Email {$user->email} sudah digunakan oleh akun lain.");
            }
        }
    }
}
