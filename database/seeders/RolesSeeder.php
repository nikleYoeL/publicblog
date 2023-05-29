<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super-admin']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'delete profiles',
            'edit profiles',
            'edit all posts',
            'delete all posts',
            'publish post',
            'unpublish post',
            'view unpublished post',
            'delete all comments',
        ]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'create post',
            'edit own post',
            'delete own post',
            'write comment',
            'delete own comment',
        ]);
    }
}
