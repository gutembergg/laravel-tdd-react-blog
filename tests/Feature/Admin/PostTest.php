<?php

namespace Tests\Feature\Admin;

use App\Enums\Role\RoleEnum;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

  
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

        $response = $this->actingAs($user)->get(route('posts.web-show', ['slug' => $post->slug]));

        $response->assertSee($post->title);
        $response->assertSee($post->slug);
        $response->assertSee($post->content);
       // $response->assertSee($post->link, $escaped = true);
        $response->assertSee($post->comment_status);
        $response->assertSee($categories[0]->name);

        $response->assertOk();
    }
}