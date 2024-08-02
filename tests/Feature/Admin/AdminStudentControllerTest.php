<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use App\Helpers\GeneratorToken;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminStudentControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_students(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~student.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_students(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~student.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $student = FakerDatabase::student();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~student.edit', $student));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $student = FakerDatabase::student();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~student.show', $student));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_students(): void
    {
        $user = FakerAuth::admin();

        $newLavel = FakerDatabase::level();


        $response = $this
            ->actingAs($user)
            ->post(route('~student.store'), [
                'name' => 'Modero',
                'firstname' => 'Mumu',
                'lastname' => 'Pulu',
                'sexy' => 'M',
                'happy' => '2000-04-20',
                'email' => 'emailstudent@gmail.com',
                'level_id' => $newLavel->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_students(): void
    {
        $student = FakerDatabase::student();

        $newLavel = FakerDatabase::level();

        $user = FakerAuth::admin();

        $token = GeneratorToken::token(8);

        $response = $this
            ->actingAs($user)
            ->put(route('~student.update', $student), [
                'name' => 'Modero',
                'firstname' => 'Mumu',
                'lastname' => 'Pulu',
                'sexy' => 'M',
                'happy' => '2000-04-20',
                'email' => 'emailstudent@gmail.com',
                'token' => $token,
                'level_id' => $newLavel->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);


        $student->refresh();



        $this->assertEquals('Modero', $student->name);
        $this->assertEquals('Mumu', $student->firstname);
        $this->assertEquals('Pulu', $student->lastname);
        $this->assertEquals('emailstudent@gmail.com', $student->email);
        $this->assertEquals($token, $student->token);
        $this->assertEquals('M', $student->sexy);
        $this->assertEquals('2000-04-20', $student->happy);
        $this->assertEquals($student->level_id, $newLavel->id);
    }

    public function test_admin_delete_resource_students(): void
    {
        $student = FakerDatabase::student();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~student.destroy', $student));

        $student->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($student->exists());
    }
}
