<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Создаем разрешения с guard_name = 'api'
        Permission::create(['name' => 'create brands', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit brands', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete brands', 'guard_name' => 'api']);

        Permission::create(['name' => 'create categories', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit categories', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete categories', 'guard_name' => 'api']);

        Permission::create(['name' => 'create clients', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit clients', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete clients', 'guard_name' => 'api']);

        Permission::create(['name' => 'create products', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit products', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete products', 'guard_name' => 'api']);


        Permission::create(['name' => 'create product variants', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit product variants', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete product variants', 'guard_name' => 'api']);

        Permission::create(['name' => 'create sizes', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit sizes', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete sizes', 'guard_name' => 'api']);

        Permission::create(['name' => 'create suppliers', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit suppliers', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete suppliers', 'guard_name' => 'api']);

        Permission::create(['name' => 'create barches', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit barches', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete barches', 'guard_name' => 'api']);

        Permission::create(['name' => 'assign roles', 'guard_name' => 'api']);
        Permission::create(['name' => 'remove roles', 'guard_name' => 'api']);
        Permission::create(['name' => 'create roles', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit roles', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete roles', 'guard_name' => 'api']);
        Permission::create(['name' => 'create permissions', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit permissions', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete permissions', 'guard_name' => 'api']);
        Permission::create(['name' => 'assign permissions', 'guard_name' => 'api']);
        Permission::create(['name' => 'remove permissions', 'guard_name' => 'api']);
        Permission::create(['name' => 'view permissions', 'guard_name' => 'api']);
        Permission::create(['name' => 'view roles', 'guard_name' => 'api']);

        // Создаем роль admin с guard_name = 'api'
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'api']);

        // Назначаем разрешения для роли admin
        $adminRole->syncPermissions([
            'create brands', 'edit brands', 'delete brands',
            'create categories', 'edit categories', 'delete categories',
            'create clients', 'edit clients', 'delete clients',
            'create products', 'edit products', 'delete products',
            'create product variants', 'edit product variants', 'delete product variants',
            'create sizes', 'edit sizes', 'delete sizes',
            'create suppliers', 'edit suppliers', 'delete suppliers',
            'create barches', 'edit barches', 'delete barches',
            'assign roles', 'remove roles', 'create roles', 'edit roles', 'delete roles',
            'create permissions', 'edit permissions', 'delete permissions',
            'assign permissions', 'remove permissions', 'view permissions', 'view roles'
        ]);
    }
}
