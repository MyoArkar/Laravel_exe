<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => "0020349234",
            'address' => "address",
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'name' => "User",
            'email' => "user@gmail.com",
            'phone' => "024392492374",
            'address' => "address",
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
