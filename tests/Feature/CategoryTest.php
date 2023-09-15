<?php

namespace Tests\Feature;

use App\Enums\Role\RoleEnum;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_categories_index_route(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $response = $this->actingAs($user)->getJson(route('categories.index'));

        $response->assertOk();
    }
}
