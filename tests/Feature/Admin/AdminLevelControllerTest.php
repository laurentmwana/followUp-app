<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLevelControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_level(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~level.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_level(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~level.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $level = FakerDatabase::level();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~level.edit', $level));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $level = FakerDatabase::level();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~level.show', $level));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_level(): void
    {
        $user = FakerAuth::admin();

        $newOption = FakerDatabase::option();

        $year = FakerDatabase::year();

        $response = $this
            ->actingAs($user)
            ->post(route('~level.store'), [
                'name' => 'L1',
                'option_id' => $newOption->id,
                'year_id' => $year->id,
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_level(): void
    {
        $level = FakerDatabase::level();

        $newOption = FakerDatabase::option();

        $year = FakerDatabase::year();

        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->put(route('~level.update', $level), [
                'name' => 'L1',
                'option_id' => $newOption->id,
                'year_id' => $year->id,

            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $level->refresh();

        $this->assertEquals('L1', $level->name);
        $this->assertEquals($level->option_id, $newOption->id);
    }

    public function test_admin_delete_resource_level(): void
    {
        $level = FakerDatabase::level();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~level.destroy', $level));

        $level->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($level->exists());
    }
}
