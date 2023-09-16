<?php

namespace Tests\Feature;

use App\Enums\Role\RoleEnum;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $this->seed(CategoriesSeeder::class);

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $response = $this->actingAs($user)->getJson(route('categories.index'));

        $category = Category::first();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['0.id', '0.name'])->etc()
            ->whereAll([
                '0.name' =>  $category->name
            ])
            ->whereAllType([
                '0.name' => 'string'
            ])
        );

        $response->assertOk();
    }
}