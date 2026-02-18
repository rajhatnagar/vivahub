<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure Admin User Exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@vivahub.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // If user existed but had wrong password/role/status, update them
        if (!$admin->wasRecentlyCreated) {
            $admin->update([
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ]);
        }
    }
}
