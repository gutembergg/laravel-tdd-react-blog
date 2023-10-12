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
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

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

        $response = $this->actingAs($user)->get(route('posts.web-show', ['slug' => $post->slug]));


       /*  $response->dump();
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['title', 'content', 'link', 'comment_status', 'author_id', 'categories'])->etc()
            ->whereAll([
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'link' => $post->link,
                'comment_status' => $post->comment_status,
                'author_id' => $post->author_id,
                'categories.0.name' => $categories[0]->name,
            ])

        ); */
        $response->assertOk();
    }
}