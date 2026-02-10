<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::query()->firstOrCreate(['name' => 'admin',],[
            'email' => 'admin@gmail.com',
            'password' => '111222',
            'email_verified_at' => now()
        ]);
    }
}
