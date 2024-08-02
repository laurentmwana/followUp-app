<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminGroupControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_group(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~group.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_group(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~group.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $group = FakerDatabase::group();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~group.edit', $group));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $group = FakerDatabase::group();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~group.show', $group));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_group(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->post(route('~group.store'), [
                'name' => 'MATH0123',
                'category_id' => FakerDatabase::category()->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_group(): void
    {
        $group = FakerDatabase::group();

        $user = FakerAuth::admin();

        $category = FakerDatabase::category();

        $response = $this
            ->actingAs($user)
            ->put(route('~group.update', $group), [
                'name' => 'MATH012',
                'category_id' => $category->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $group->refresh();

        $this->assertEquals('MATH012', $group->name);
        $this->assertEquals($category->id, $group->category_id);
    }
    public function test_admin_delete_resource_group(): void
    {
        $group = FakerDatabase::group();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~group.destroy', $group));

        $group->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($group->exists());
    }
}
