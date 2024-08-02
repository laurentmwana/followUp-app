<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_category(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~category.index'));

        $response->assertStatus(200);
    }
}
