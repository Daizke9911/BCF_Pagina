<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'ver usuario']);
        Permission::create(['name' => 'crear usuario']);
        Permission::create(['name' => 'modificar usuario']);
        Permission::create(['name' => 'eliminar usuario']);
    }
}
