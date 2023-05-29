<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissions for post
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit all posts']);
        Permission::create(['name' => 'edit own post']);
        Permission::create(['name' => 'delete all posts']);
        Permission::create(['name' => 'delete own post']);
        Permission::create(['name' => 'publish post']);
        Permission::create(['name' => 'unpublish post']);
        Permission::create(['name' => 'view unpublished post']);

        // permissions for comment
        Permission::create(['name' => 'write comment']);
        Permission::create(['name' => 'delete all comments']);
        Permission::create(['name' => 'delete own comment']);

        // permissions for profile
        Permission::create(['name' => 'delete profiles']);
        Permission::create(['name' => 'edit profiles']);
    }
}
