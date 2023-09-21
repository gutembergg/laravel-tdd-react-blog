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

        $categories = Category::all();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $view = $this->view('admin.categories', ['categories' => $categories]);

        $response->assertOk();

        $view->assertSee($categories[0]->name);
        $view->assertSee($categories[1]->name);
        $view->assertSee($categories[2]->name);
    }
}