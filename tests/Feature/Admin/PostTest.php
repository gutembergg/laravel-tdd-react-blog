<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Enums\Role\RoleEnum;
use Database\Seeders\RoleSeeder;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_admin_show_post(): void
    {
        $this->seed(RoleSeeder::class);
        $this->seed(CategoriesSeeder::class);

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
            'user_id' => $user->id,
        ]);

        $categories = Category::all()->random(2);

        $post = Post::factory(1)->hasAttached($categories)->for($author)->createOne();

        $this->assertDatabaseCount('category_post', 2);
        
        $response = $this->actingAs($user)->get(route('posts.web-show', ['slug' => $post->slug]));

        $response->assertOk();
    }
}