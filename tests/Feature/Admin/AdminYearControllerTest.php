<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Helpers\Faker\FakerAuth;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminYearControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_admin_home_years(): void
    {
        $user = FakerAuth::admin();

        $response = $this
            ->actingAs($user)
            ->get(route('~year.index'));

        $response->assertStatus(200);
    }

    public function test_admin_closed_year(): void
    {
        $user = FakerAuth::admin();

        $year = FakerDatabase::year();

        $response = $this
            ->actingAs($user)
            ->post(route('~year.closed', $year));

        $response->assertStatus(302);
    }


    public function test_admin_show_info_year(): void
    {
        $user = FakerAuth::admin();

        $year = FakerDatabase::year();

        $response = $this
            ->actingAs($user)
            ->get(route('~year.show', $year));

        $response->assertStatus(200);
    }
}
