<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();





        User::factory()->create([
            'name' => 'Padoda',
            'email' => 'padoda@test.com',
            'role' => RoleEnum::ROLE_ADMIN->value,
        ]);

        User::factory()->create([
            'name' => 'Labeya',
            'email' => 'lab@test.com',
            'role' => RoleEnum::ROLE_STUDENT->value,
        ]);
    }
}
