<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCoordinatorControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_coordinator(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~coordinator.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_coordinator(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~coordinator.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $coordinator = FakerDatabase::coordinator();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~coordinator.edit', $coordinator));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $coordinator = FakerDatabase::coordinator();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~coordinator.show', $coordinator));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_coordinator(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->post(route('~coordinator.store'), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F'
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_coordinator(): void
    {
        $coordinator = FakerDatabase::coordinator();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->put(route('~coordinator.update', $coordinator), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F',
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);


        $coordinator->refresh();

        $this->assertEquals('Muteba', $coordinator->name);
        $this->assertEquals('Moko', $coordinator->firstname);
        $this->assertEquals('lab@gmail.com', $coordinator->email);
        $this->assertEquals('F', $coordinator->sex);
        $this->assertEquals('243820645973', $coordinator->phone);
    }


    public function test_admin_create_or_update_collection_professors_courses(): void
    {
        $coordinator = FakerDatabase::coordinator();

        $user = FakerAuth::admin();

        $coursesCollection = FakerDatabase::course(4);
        $professorsCollection = FakerDatabase::professor(4);

        $response = $this
            ->actingAs($user)
            ->put(route('~coordinator.update', $coordinator), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F',
                'courses' => $coursesCollection->toArray(),
                'professors' => $professorsCollection->toArray(),
            ]);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertStatus(302);


        $coordinator->refresh();

        $this->assertEquals('Muteba', $coordinator->name);
        $this->assertEquals('Moko', $coordinator->firstname);
        $this->assertEquals('lab@gmail.com', $coordinator->email);
        $this->assertEquals('F', $coordinator->sex);
        $this->assertEquals('243820645973', $coordinator->phone);

        $this->assertEquals(
            $coursesCollection->count(),
            count($coordinator->courses)
        );
        $this->assertEquals(
            $professorsCollection->count(),
            count($coordinator->professors)
        );
    }


    public function test_admin_delete_resource_coordinator(): void
    {
        $coordinator = FakerDatabase::coordinator();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~coordinator.destroy', $coordinator));

        $coordinator->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($coordinator->exists());
    }
}
