<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'permissions.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'permissions.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'permissions.hapus', 'guard_name' => 'api']);

        Permission::create(['name' => 'role.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'role.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'role.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'role.hapus', 'guard_name' => 'api']);

        Permission::create(['name' => 'users.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.detail', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.hapus', 'guard_name' => 'api']);


        Permission::create(['name' => 'perusahaan.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'perusahaan.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'perusahaan.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'perusahaan.detail', 'guard_name' => 'api']);
        Permission::create(['name' => 'perusahaan.disabled', 'guard_name' => 'api']);
        Permission::create(['name' => 'perusahaan.enable', 'guard_name' => 'api']);
    }
}
