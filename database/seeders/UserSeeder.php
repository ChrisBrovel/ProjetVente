<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $avatars = [
            'avatars/avatar1.jpeg',
            'avatars/avatar2.jpeg',
            'avatars/avatar3.jpeg',
            'avatars/avatar4.jpeg',
            'avatars/avatar5.jpeg',
        ];

        $names = [
            'Alice RETENO',
            'Bob VESPUCY',
            'Charlie OBAME',
            'David MANSO',
            'Eve MBIA',
        ];

        foreach ($names as $index => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name).'@example.com',
                'password' => Hash::make('password123'),
                'avatar' => $avatars[$index],
            ]);
        }
    }
}
