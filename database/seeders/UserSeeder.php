<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Student;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => RoleEnum::ROLE_ADMIN->value,
            'email' => 'demo@gmail.com',
            'name' => 'padoda',
        ]);
    }
}
