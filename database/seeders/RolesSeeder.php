<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::Create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => json_encode([
                'edit-user' => true,
                'update-user' => true,
                'delete-user' => true,
                'force-logout' => true,
            ])
        ]);

        $user = Role::Create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => json_encode([

            ])
        ]);
    }
}
