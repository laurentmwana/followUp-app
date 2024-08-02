<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDepartmentControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_department(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~department.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_department(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~department.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $department = FakerDatabase::department();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~department.edit', $department));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $department = FakerDatabase::department();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~department.show', $department));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_department(): void
    {
        $user = FakerAuth::admin();

        $newFaculty = FakerDatabase::faculty();

        $response = $this
            ->actingAs($user)
            ->post(route('~department.store'), [
                'name' => 'Science et Technologies',
                'faculty_id' => $newFaculty->id,
                'alias' => 'Sc'
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_department(): void
    {
        $department = FakerDatabase::department();

        $newFaculty = FakerDatabase::faculty();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->put(route('~department.update', $department), [
                'name' => 'Science et Technologies Update',
                'alias' => 'ST',
                'faculty_id' => $newFaculty->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $department->refresh();

        $this->assertEquals('Science et Technologies Update', $department->name);
        $this->assertEquals('ST', $department->alias);
        $this->assertEquals($department->faculty_id, $newFaculty->id);
    }

    public function test_admin_delete_resource_department(): void
    {
        $department = FakerDatabase::department();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~department.destroy', $department));

        $department->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($department->exists());
    }
}
