<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDeanControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_dean(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~dean.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_dean(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~dean.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $dean = FakerDatabase::dean();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~dean.edit', $dean));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $dean = FakerDatabase::dean();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~dean.show', $dean));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_dean(): void
    {
        $user = FakerAuth::admin();

        $professor = FakerDatabase::professor();

        $response = $this
            ->actingAs($user)
            ->post(route('~dean.store'), [
                'professor_id' => $professor->id,
                'faculty_id' => $professor->department->faculty_id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_dean(): void
    {
        $user = FakerAuth::admin();

        $dean = FakerDatabase::dean();

        $professor = FakerDatabase::professor();

        $response = $this
            ->actingAs($user)
            ->put(route('~dean.update', $dean), [
                'professor_id' => $professor->id,
                'faculty_id' => $professor->department->faculty_id,
            ]);

        $dean->refresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertEquals($dean->professor_id, $professor->id);
        $this->assertEquals($dean->faculty_id, $professor->department->faculty_id);
    }


    public function test_admin_delete_resource_dean(): void
    {
        $dean = FakerDatabase::dean();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~dean.destroy', $dean));

        $dean->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($dean->exists());
    }
}
