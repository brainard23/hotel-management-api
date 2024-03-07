<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'first_name' => 'Admin',
            'last_name' => '1',
            'email' => 'admin@gmail.com',
            'role' => 'administrator',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'date_of_birthday' => now(),
        ]);

        // $user->assignRole('admin');
    }
}
