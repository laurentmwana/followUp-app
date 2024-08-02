<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCourseControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_course(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~course.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_course(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~course.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $course = FakerDatabase::course();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~course.edit', $course));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $course = FakerDatabase::course();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~course.show', $course));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_course(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->post(route('~course.store'), [
                'name' => 'Math',
                'credits' => 4,
                'description' => 'je suis ce que je suis grâce à ce que nous sommes tous.',
                'professor_id' => FakerDatabase::professor()->id,
                'semester_id' => FakerDatabase::semester()->id,
                'group_id' => FakerDatabase::group()->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_course(): void
    {
        $course = FakerDatabase::course();

        $user = FakerAuth::admin();

        $professor = FakerDatabase::professor();

        $semester = FakerDatabase::semester();

        $group = FakerDatabase::group();

        $response = $this
            ->actingAs($user)
            ->put(route('~course.update', $course), [
                'name' => 'Math',
                'credits' => 4,
                'description' => 'je suis ce que je suis grâce à ce que nous sommes tous.',
                'professor_id' => $professor->id,
                'semester_id' => $semester->id,
                'group_id' => $group->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $course->refresh();

        $this->assertEquals('Math', $course->name);
        $this->assertEquals($professor->id, $course->professor_id);
        $this->assertEquals(4, $course->credits);
        $this->assertEquals($semester->id, $course->semester_id);
        $this->assertEquals($group->id, $course->group_id);

        $this->assertEquals(
            'je suis ce que je suis grâce à ce que nous sommes tous.',
            $course->description
        );
    }

    public function test_admin_sync_collection_levels_and_students(): void
    {
        $course = FakerDatabase::course();

        $user = FakerAuth::admin();

        $studentCollection = FakerDatabase::student(4);

        $levelsCollection = FakerDatabase::level(4);

        $professor = FakerDatabase::professor();

        $semester = FakerDatabase::semester();

        $group = FakerDatabase::group();

        $response = $this
            ->actingAs($user)
            ->put(route('~course.update', $course), [
                'name' => 'Math',
                'credits' => 4,
                'description' => 'je suis ce que je suis grâce à ce que nous sommes tous.',
                'students' => $studentCollection->toArray(),
                'levels' => $levelsCollection->toArray(),
                'professor_id' => $professor->id,
                'semester_id' => $semester->id,
                'group_id' => $group->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $course->refresh();

        $this->assertEquals('Math', $course->name);
        $this->assertEquals(4, $course->credits);
        $this->assertEquals($professor->id, $course->professor_id);
        $this->assertEquals($semester->id, $course->semester_id);
        $this->assertEquals(
            'je suis ce que je suis grâce à ce que nous sommes tous.',
            $course->description
        );

        $this->assertEquals($levelsCollection->count(), count($course->levels));
        $this->assertEquals($studentCollection->count(), count($course->students));
    }

    public function test_admin_delete_resource_course(): void
    {
        $course = FakerDatabase::course();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~course.destroy', $course));

        $course->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($course->exists());
    }
}
