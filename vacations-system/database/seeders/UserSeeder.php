<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
{
    User::firstOrCreate(
        ['email' => 'admin@vacations.com'],
        [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]
    );

    User::firstOrCreate(
        ['email' => 'user@vacations.com'],
        [
            'name' => 'Regular User',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]
    );
}
}