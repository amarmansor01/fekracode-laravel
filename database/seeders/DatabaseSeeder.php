<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // الشرط: إذا موجود بنفس الإيميل ما ينضاف مرتين
            [
                'name' => 'admin',
                'password' => Hash::make('a0940379366'),
                'role' => 'admin',
            ]
        );
    }
}
