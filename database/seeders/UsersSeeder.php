<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = new User();
        $user1->name = 'user-1';
        $user1->email = 'admin@example.com';
        $user1->password = bcrypt('P1s2w3r4d');
        $user1->save();

        $user2 = new User();
        $user2->name = 'user-2';
        $user2->email = 'user@example.com';
        $user2->password = bcrypt('P1s2w3r4d');
        $user2->save();

        $user1->syncRoles('user', 'admin');
        $user2->assignRole('user');
    }
}
