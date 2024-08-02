<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminNoteControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_note(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~note.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_note(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~note.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $note = FakerDatabase::note();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~note.edit', $note));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $note = FakerDatabase::note();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~note.show', $note));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_note(): void
    {
        $user = FakerAuth::admin();

        $student = FakerDatabase::student();
        $course = FakerDatabase::course();
        $semester = FakerDatabase::semester();

        $response = $this
            ->actingAs($user)
            ->post(route('~note.store'), [
                'note' => 18,
                'course_id' => $course->id,
                'student_id' => $student->id,
                'semester_id' => $semester->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_note(): void
    {

        $user = FakerAuth::admin();

        $course = FakerDatabase::course();
        $student = FakerDatabase::student();
        $semester = FakerDatabase::semester();

        $note = FakerDatabase::note();

        $response = $this
            ->actingAs($user)
            ->put(route('~note.update', $note), [
                'note' => 18,
                'course_id' => $course->id,
                'student_id' => $student->id,
                'semester_id' => $semester->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $note->refresh();

        $this->assertEquals(18, $note->note);
        $this->assertEquals($student->id, $note->student_id);
        $this->assertEquals($course->id, $note->course_id);
        $this->assertEquals($semester->id, $note->semester_id);
    }
    public function test_admin_delete_resource_note(): void
    {
        $note = FakerDatabase::note();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~note.destroy', $note));

        $note->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($note->exists());
    }
}
