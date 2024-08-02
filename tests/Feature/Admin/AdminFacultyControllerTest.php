<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminFacultyControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_faculty(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~faculty.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_faculty(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~faculty.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $faculty = FakerDatabase::faculty();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~faculty.edit', $faculty));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $faculty = FakerDatabase::faculty();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~faculty.show', $faculty));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_faculty(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->post(route('~faculty.store'), [
                'name' => 'Science et Technologies',
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_faculty(): void
    {
        $faculty = FakerDatabase::faculty();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->put(route('~faculty.update', $faculty), [
                'name' => 'Science et Technologies Update',
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $faculty->refresh();

        $this->assertEquals('Science et Technologies Update', $faculty->name);
    }

    public function test_admin_delete_resource_faculty(): void
    {
        $faculty = FakerDatabase::faculty();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~faculty.destroy', $faculty));

        $faculty->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($faculty->exists());
    }
}
