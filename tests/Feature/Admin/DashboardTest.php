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

        $authentinadedUser = $this->actingAs($user);
        $categories = Category::all();

        $author = Author::factory()
            ->has(Post::factory(5)
            ->hasAttached($categories->random(2)))
            ->create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);

        $posts = $author['posts'];
        
        $response = $this->actingAs($user)->get(route('dashboard', [
            'category' => $categories,
            'posts' => $posts,
        ]));

        $lastPosts = $response['posts'];

        $view = $this->blade(
            '<x-admin.store-post-form :categories="$categories" />',
            ['categories' => $categories]
        );
        $view->assertSee($categories->first()->name);

        $view = $this->blade(
            '<x-admin.last-posts :posts="$posts" />',
            ['posts' => $lastPosts]
        );
        $view->assertSee($lastPosts->first()->title);

       // $view = $this->view('admin.index', ['categories' => $categories, 'posts' => $lastPosts]);

        $response->assertStatus(200);

    }
}