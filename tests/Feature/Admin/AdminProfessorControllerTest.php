<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminProfessorControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_professor(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~professor.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_professor(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~professor.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $course = FakerDatabase::course();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~professor.edit', $course));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $professor = FakerDatabase::professor();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~professor.show', $professor));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_professor(): void
    {
        $user = FakerAuth::admin();


        $department = FakerDatabase::department();

        $response = $this
            ->actingAs($user)
            ->post(route('~professor.store'), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F',
                'department_id' => $department->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_professor(): void
    {
        $professor = FakerDatabase::professor();

        $user = FakerAuth::admin();

        $department = FakerDatabase::department();


        $response = $this
            ->actingAs($user)
            ->put(route('~professor.update', $professor), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F',
                'department_id' => $department->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);


        $professor->refresh();

        $this->assertEquals('Muteba', $professor->name);
        $this->assertEquals('Moko', $professor->firstname);
        $this->assertEquals('lab@gmail.com', $professor->email);
        $this->assertEquals('243820645973', $professor->phone);
        $this->assertEquals('F', $professor->sex);
        $this->assertEquals($professor->department_id, $department->id);
    }

    public function test_admin_delete_resource_professor(): void
    {
        $professor = FakerDatabase::professor();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~professor.destroy', $professor));

        $professor->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($professor->exists());
    }
}
