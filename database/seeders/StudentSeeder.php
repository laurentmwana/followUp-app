<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Enums\RoleEnum;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::find(1)
            ->students()->sync(Student::pluck('id')->toArray());
    }
}
