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
use App\Generator\Token;
use App\Models\Category;
use App\Models\Semester;
use App\Models\Professor;
use App\Models\Programme;
use Illuminate\Support\Str;
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
        $years = Year::factory()->createMany([
            ['start' => 2021, 'end' => 2022, 'state' => 1],
            ['start' => 2022, 'end' => 2023, 'state' => 0],
        ]);

        // Create options and programmes
        $department->options()->createMany(self::OPTIONS);

        Programme::factory()->createMany(self::PROGRAMMES);

        Category::factory()->createMany([
            ['name' => 'A'],
            ['name' => 'B'],
        ]);

        $start = 1;
        $end = 2;
        foreach (Programme::all() as $programme) {

            for ($i = $start; $i <= $end; $i++) {
                $programme->semesters()->create([
                    'name' => "Semestre {$i}", 'alias' => "S{$i}",
                ]);
            }
            $start = $end + 1;
            $end += 2;
        }


        Programme::find(1)->levels()->create([
            'option_id' => Option::find(1)->id,
            'year_id' => Year::find(1)->id,
        ]);

        Programme::find(2)->levels()->create([
            'option_id' => Option::find(3)->id,
            'year_id' => Year::find(2)->id,
        ]);

        Professor::factory(5)->create();

        Student::factory(2)->create()->each(function (Student $student) {
            User::factory()->create([
                'role' => ROleEnum::ROLE_STUDENT->value,
                'student_id' => $student->id,
            ]);
        });

        foreach (Student::all() as $student) {
            $student->levels()->sync(Level::pluck('id'));
        }
    }
}
