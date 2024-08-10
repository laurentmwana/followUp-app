<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Year;
use App\Models\Group;
use App\Models\Level;
use App\Models\Option;
use App\Models\Faculty;
use App\Models\Category;
use App\Models\Semester;
use App\Models\Professor;
use App\Models\Programme;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Code::factory()->createMany([
            ['name' => '082'],
            ['name' => '081'],
            ['name' => '080'],
            ['name' => '099'],
            ['name' => '098'],
            ['name' => '097'],
            ['name' => '085'],
            ['name' => '089'],
            ['name' => '090'],
        ]);

        Programme::factory()->createMany([
            ['name' => 'Licence 1', 'alias' => 'L1'],
            ['name' => 'Licence 2', 'alias' => 'L2'],
            ['name' => 'Licence 3', 'alias' => 'L3'],
        ]);

        Faculty::factory()->create([
            'name' => 'Sciences et Technologies',
        ])->departments()->create([
            'name' => 'Mathematique Statistique et Informatique',
            'alias' => 'MSI'
        ])->options()->createMany([
            ['name' => 'Mathematique Statistique et Informatique', 'alias' => 'MSI'],
            ['name' => 'Mathematique Statistique', 'alias' => 'MATH-STAT'],
            ['name' => 'Informatique', 'alias' => 'INFO'],
        ]);


        Programme::find(1)->semesters()->createMany([
            ['name' => 'Semestre 1', 'alias' => 'S1'],
            ['name' => 'Semestre 2', 'alias' => 'S2'],
        ]);

        Programme::find(2)->semesters()->createMany([
            ['name' => 'Semestre 3', 'alias' => 'S3'],
            ['name' => 'Semestre 4', 'alias' => 'S4'],
        ]);

        Programme::find(3)->semesters()->createMany([
            ['name' => 'Semestre 5', 'alias' => 'S5'],
            ['name' => 'Semestre 6', 'alias' => 'S6'],
        ]);

        Category::factory()->createMany([
            ['name' => 'A'],
            ['name' => 'B'],
        ]);

        foreach (Category::all() as $c) {

            Group::factory()->create([
                'category_id' => $c->id,
                'semester_id' => Semester::find(1)->id,
            ]);

            Group::factory()->create([
                'category_id' => $c->id,
                'semester_id' => Semester::find(2)->id,
            ]);
        }

        Professor::factory(12)->create();

        Year::factory()->createMany([
            ['start' => 2021, 'end' => 2022, 'state' => 0],
            ['start' => 2022, 'end' => 2023, 'state' => 1],
        ]);

        Level::factory()->create([
            'programme_id' => Programme::find(1)->id,
            'option_id' => Option::find(1)->id,
            'year_id' => Year::find(1)->id,
        ]);
    }
}
