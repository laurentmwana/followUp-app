<?php

namespace App\Fake;

use App\Models\Note;
use App\Models\User;
use App\Models\Year;
use App\Models\Group;
use App\Models\Level;
use App\Models\Course;
use App\Models\Option;
use App\Enums\RoleEnum;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Category;
use App\Models\Semester;
use App\Models\Professor;
use App\Models\Programme;
use App\Models\Deliberation;

abstract class DataFaker
{
    public const OPTIONS = [
        ['name' => 'Mathematique Statistique et Informatique', 'alias' => 'MATH-INFO'],
        ['name' => 'Mathematique Statistique', 'alias' => 'MS'],
        ['name' => 'Informatique', 'alias' => 'INFO'],
    ];

    public const PROGRAMMES = [
        ['name' => 'Licence 1', 'alias' => 'L1'],
        ['name' => 'Licence 2', 'alias' => 'L2'],
        ['name' => 'Licence 3', 'alias' => 'L3'],
    ];

    public const GROUPS = [
        'MATH',
        'INFO',
        'STAT',
        'CODE'
    ];

    public static function generate(): void
    {
        // Create the admin user
        User::factory()->create([
            'name' => 'Padoda',
            'email' => 'padoda@test.com',
            'role' => RoleEnum::ROLE_ADMIN->value,
        ]);

        // Create the faculty and department
        $faculty = Faculty::factory()->create([
            'name' => 'Sciences et Technologies',
        ]);

        $department = $faculty->departments()->create([
            'name' => 'Mathematique Statistique et Informatique',
            'alias' => 'MSI'
        ]);

        // Create years
        for ($i = 2021; $i <= 2023; $i++) {
            Year::factory()->create([
                'start' => $i,
                'end' => $i + 1,
                'state' => $i === 2023 ? 0 : 1,
            ]);
        }

        // Create options and programmes
        $department->options()->createMany(self::OPTIONS);

        Programme::factory()->createMany(self::PROGRAMMES);

        $students = Student::factory(4)->create()->each(function (Student $student) {
            User::factory()->create([
                'student_id' => $student->id,
                'role' => RoleEnum::ROLE_STUDENT->value,
            ]);
        });

        Category::factory()->createMany([
            ['name' => 'A'],
            ['name' => 'B',],
        ]);

        foreach (Year::where('id', '!=', 3)->get() as $year) {

            $levels[] = $year->levels()->create([
                'programme_id'  => Programme::find(1)->id,
                'option_id' => Option::find(1)->id,
            ]);

            foreach (Option::where('id', '>', 1)->get() as $o) {
                $levels[] = $year->levels()->create([
                    'programme_id'  => Programme::find(2)->id,
                    'option_id' => $o->id,
                ]);
            }
        }

        foreach (Level::where())



    }
}
