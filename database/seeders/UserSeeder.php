<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
       
        $adminUser = User::firstOrCreate(
            ['login' => 'admin'], 
            [
                'name' => 'Admin User',
                'password' => bcrypt('admin_password'), 
            ]
        );

        
        $adminRole = Role::findByName('admin','api');

        if (!$adminUser->hasRole($adminRole)) {
            $adminUser->assignRole($adminRole);
        }
    }
}
