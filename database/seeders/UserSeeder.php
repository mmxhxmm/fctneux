<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'telefono' => '123456789',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'coordinador',
            'email' => 'coordinador@gmail.com',
            'telefono' => '123456789',
            'password' => Hash::make('123456'),
            'role' => 'coordinador'
        ]);

        User::create([
            'name' => 'registrador',
            'email' => 'registrador@gmail.com',
            'telefono' => '123456789',
            'password' => Hash::make('123456'),
            'role' => 'registrador'
        ]);
    }
}
