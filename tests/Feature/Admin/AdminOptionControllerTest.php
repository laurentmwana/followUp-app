<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminOptionControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_option(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~option.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_option(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~option.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $option = FakerDatabase::option();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~option.edit', $option));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $option = FakerDatabase::option();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~option.show', $option));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_option(): void
    {
        $user = FakerAuth::admin();

        $newDepartment = FakerDatabase::department();

        $response = $this
            ->actingAs($user)
            ->post(route('~option.store'), [
                'name' => 'Mathematique',
                'department_id' => $newDepartment->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_option(): void
    {
        $option = FakerDatabase::option();

        $newDepartment = FakerDatabase::department();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->put(route('~option.update', $option), [
                'name' => 'Informatique Update',
                'department_id' => $newDepartment->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $option->refresh();

        $this->assertEquals('Informatique Update', $option->name);
        $this->assertEquals($option->department_id, $newDepartment->id);
    }

    public function test_admin_delete_resource_option(): void
    {
        $option = FakerDatabase::option();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~option.destroy', $option));

        $option->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($option->exists());
    }
}
