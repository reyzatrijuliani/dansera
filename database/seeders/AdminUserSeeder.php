<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dansera.com'],
            [
                'name' => 'Admin Dansera',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );
    }
}