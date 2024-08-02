<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAssistantControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_assistant(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~assistant.index'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_assistant(): void
    {
        $user = FakerAuth::admin();
        $response = $this
            ->actingAs($user)
            ->get(route('~assistant.create'));

        $response->assertStatus(200);
    }

    public function test_admin_show_form_create_edit(): void
    {
        $assistant = FakerDatabase::assistant();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~assistant.edit', $assistant));

        $response->assertStatus(200);
    }

    public function test_admin_show_more_information(): void
    {
        $assistant = FakerDatabase::assistant();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~assistant.show', $assistant));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource_assistant(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->post(route('~assistant.store'), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F'
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);
    }

    public function test_admin_update_resource_assistant(): void
    {
        $assistant = FakerDatabase::assistant();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->put(route('~assistant.update', $assistant), [
                'name' => 'Muteba',
                'firstname' => 'Moko',
                'email' => 'lab@gmail.com',
                'phone' => '243820645973',
                'sex' => 'F',
            ]);

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);


        $assistant->refresh();

        $this->assertEquals('Muteba', $assistant->name);
        $this->assertEquals('Moko', $assistant->firstname);
        $this->assertEquals('lab@gmail.com', $assistant->email);
        $this->assertEquals('F', $assistant->sex);
        $this->assertEquals('243820645973', $assistant->phone);
    }


    public function test_admin_create_or_update_collection_professors_courses(): void
    {
        $assistant = FakerDatabase::assistant();

        $user = FakerAuth::admin();

        $coursesCollection = FakerDatabase::course(4);
        $professorsCollection = FakerDatabase::professor(4);

        $response = $this
            ->actingAs($user)
            ->put(route('~assistant.update', $assistant), [
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


        $assistant->refresh();

        $this->assertEquals('Muteba', $assistant->name);
        $this->assertEquals('Moko', $assistant->firstname);
        $this->assertEquals('lab@gmail.com', $assistant->email);
        $this->assertEquals('F', $assistant->sex);
        $this->assertEquals('243820645973', $assistant->phone);

        $this->assertEquals(
            $coursesCollection->count(),
            count($assistant->courses)
        );
        $this->assertEquals(
            $professorsCollection->count(),
            count($assistant->professors)
        );
    }


    public function test_admin_delete_resource_assistant(): void
    {
        $assistant = FakerDatabase::assistant();

        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->delete(route('~assistant.destroy', $assistant));

        $assistant->fresh();

        $response->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertFalse($assistant->exists());
    }
}
