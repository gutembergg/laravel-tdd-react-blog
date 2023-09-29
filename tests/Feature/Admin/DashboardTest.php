<?php

namespace Tests\Feature\Admin;

use App\Enums\Role\RoleEnum;
use App\Models\Author;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_dashboard_route(): void
    {

        $this->seed(RoleSeeder::class);
        $this->seed(CategoriesSeeder::class);
        
        $user = User::factory()
            ->create()
            ->assignRole(fake()
                    ->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value]));

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);

    }
}