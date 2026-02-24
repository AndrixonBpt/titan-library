<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. El Bibliotecario (Admin)
        User::create([
            'name' => 'Admin Titan',
            'email' => 'admin@titan.com',
            'password' => Hash::make('jean1234'), // Contraseña segura
            'role' => 'bibliotecario' // <--- ROL IMPORTANTE
        ]);

        // 2. El Lector Común
        User::create([
            'name' => 'Lector Invitado',
            'email' => 'lector@titan.com',
            'password' => Hash::make('jean1234'),
            'role' => 'lector'
        ]);
    }
}