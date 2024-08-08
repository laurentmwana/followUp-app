<?php

namespace Database\Seeders;

use App\Models\Level;
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
        foreach (Student::all() as $student) {
            $student->levels()->sync(Level::find(1));
        }
    }
}
