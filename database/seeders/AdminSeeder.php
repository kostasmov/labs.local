<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'login' => 'admin',
            'name' => 'Мовенко Константин Михайлович',
            'email' => 'kostasmov@mail.ru',
            'password' => Hash::make('0000'),
            'is_admin' => true
        ]);
    }
}
