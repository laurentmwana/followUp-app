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

        $students = [
            ['name' => 'NTUMBA', 'firstname' => 'NKITA'],
            ['name' => 'MUKUNGI', 'firstname' => 'MUSEMES'],
            ['name' => 'BOBELE', 'firstname' => 'BOLONGOMBA'],
            ['name' => 'ISAKO', 'firstname' => 'IYOTA'],
        ];

        foreach ($students as $key => $student) {
            $newStudent = Student::factory()->create([
                'name' => $student['name'],
                'firstname' => $student['firstname'],
            ]);

            User::factory()
                ->create(['student_id' => $newStudent->id]);

            if ($key >= 0 && $key < 2) {
                $newStudent->choice()->create([
                    'option_id' => 3
                ]);
            }

            if ($key >= 2 && $key < 4) {
                $newStudent->choice()->create([
                    'option_id' => 2
                ]);
            }
        }
    }
}
