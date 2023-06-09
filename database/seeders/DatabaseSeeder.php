<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            CategoriesSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
        ]);

        Post::factory()
            ->count(30)
            ->create();

        Post::factory()
        ->count(15)
        ->create([
            'published' => null,
        ]);
    }
}
