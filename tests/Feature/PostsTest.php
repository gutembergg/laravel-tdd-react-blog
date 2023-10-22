<?php

namespace Tests\Feature;

use App\Enums\Role\RoleEnum;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_index_route(): void
    {
        $this->seed(CategoriesSeeder::class);

        $expectedResponseSize = 8;

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        $posts = Post::factory(10)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200);

        $this->assertCount($expectedResponseSize, $response['data']);

        $post = $posts->first();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->first(fn (AssertableJson $json) => $json->whereAll([
                '0.title' => $post->title,
                '0.slug' => $post->slug,
                '0.content' => $post->content,
                '0.link' => $post->link,
                '0.comment_status' => $post->comment_status,
                '0.categories.0.name' => $categories[0]->name,
            ])
                ->hasAll(['0.title',
                    '0.slug',
                    '0.content',
                    '0.link',
                    '0.comment_status',
                    '0.author',
                    '0.categories',
                ])->etc()
                ->whereAllType([
                    '0.title' => 'string',
                    '0.slug' => 'string',
                    '0.content' => 'string',
                    '0.link' => 'string',
                    '0.comment_status' => 'boolean',
                ])
            )
        );

    }

    public function test_posts_show_route(): void
    {
        $this->seed(CategoriesSeeder::class);

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        $post = Post::factory(1)->hasAttached($categories)->for($author)->createOne();

        $response = $this->getJson(route('posts.show', ['slug' => $post->slug]));

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['data.title', 'data.slug', 'data.content', 'data.link', 'data.comment_status', 'data.author', 'data.categories'])->etc()
            ->whereAllType([
                'data.title' => 'string',
                'data.slug' => 'string',
                'data.content' => 'string',
                'data.link' => 'string',
                'data.comment_status' => 'boolean',
            ])
            ->whereAll([
                'data.title' => $post->title,
                'data.slug' => $post->slug,
                'data.content' => $post->content,
                'data.link' => $post->link,
                'data.comment_status' => $post->comment_status,
                'data.author.id' => $post->author_id,
                'data.categories.0.name' => $categories[0]->name,
            ])

        );
    }

    public function test_posts_show_route_error(): void
    {
        Post::factory(1)->createOne();

        $response = $this->getJson(route('posts.show', ['slug' => 'INVALID_SLUG']));

        $response->assertNotFound();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['error', 'message'])
            ->whereAllType([
                'error' => 'boolean',
                'message' => 'string',
            ])
            ->whereAll([
                'error' => true,
                'message' => 'Post not found',
            ])
        );
    }

    public function test_posts_with_author_store_route(): void
    {
        Storage::fake('local');

        $this->seed(RoleSeeder::class);
        $this->seed(CategoriesSeeder::class);

        $post = new Post();

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $author = Author::factory()->create([
            'name' => $user->name,
            'user_id' => $user->id,
        ]);

        $post->title = 'TEST TITLE ONE';
        $post->content = fake()->paragraph();
        $slug = $post->slug = $post->title;
        $link = $post->link = $post->title;

        $categories = [...Category::all()->pluck('id')->random(2)];

        $file = UploadedFile::fake()->image('photo1.jpg');

        $response = $this->actingAs($user)->withHeaders([
            'Content-Type' => 'multipart/form-data',
        ])->post(route('posts.store', [
            'title' => $post->title,
            'content' => $post->content,
            'slug' => $slug,
            'link' => $link,
            'categories' => $categories,
        ],

            ['media' => $file]

        ));

        // Storage::disk('local')->assertExists($file->hashName());

        $this->assertDatabaseCount('category_post', 2);

        $response->assertValid(['title', 'content', 'categories']);

        $response->assertRedirect();

        $insertedPost = Post::first();
        $this->assertEquals($insertedPost->title, $post->title);
        $this->assertEquals($insertedPost->content, $post->content);
        $this->assertEquals($insertedPost->slug, $post->slug);
        $this->assertEquals($insertedPost->link, $post->link);
        $this->assertEquals($insertedPost->author_id, $author->id);

    }

    public function test_posts_without_author_store_route(): void
    {
        $this->seed(RoleSeeder::class);
        $this->seed(CategoriesSeeder::class);

        $post = new Post();

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $post->title = 'TEST TITLE ONE';
        $post->content = fake()->paragraph();
        $slug = $post->slug = $post->title;
        $link = $post->link = $post->title;

        $categories = [...Category::all()->pluck('id')->random(2)];

        $response = $this->actingAs($user)->postJson(route('posts.store', [
            'title' => $post->title,
            'content' => $post->content,
            'slug' => $slug,
            'link' => $link,
            'categories' => $categories,
        ]));

        $this->assertDatabaseCount('category_post', 2);

        $response->assertValid(['title', 'content', 'categories']);

        $response->assertRedirect();

        $insertedPost = Post::first();
        $this->assertEquals($insertedPost->title, $post->title);
        $this->assertEquals($insertedPost->content, $post->content);
        $this->assertEquals($insertedPost->slug, $post->slug);
        $this->assertEquals($insertedPost->link, $post->link);

        $this->assertDatabaseCount('authors', 1);
    }

    public function test_erros_posts_store_route(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $response = $this->actingAs($user)->postJson(route('posts.store', [
            'title' => '1',
            'content' => '',
            'slug' => 'SLUG',
            'link' => 'LINK',
            'author_id' => $user->id,
        ]));

        $response->assertInvalid(['title', 'content']);
    }

    public function test_erros_posts_store_userRole_route(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create()->assignRole(RoleEnum::USER->value);

        $response = $this->actingAs($user)->postJson(route('posts.store', [
            'title' => 'user role title',
            'content' => 'user role content',
            'slug' => 'SLUG',
            'link' => 'LINK',
            'author_id' => $user->id,
        ]));

        $response->assertForbidden();
    }

    public function test_posts_search_is_empyt(): void
    {
        $this->seed(CategoriesSeeder::class);

        $numberOfPaginate = 6;

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        Post::factory(10)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.search', ['search' => '', 'direction' => '']));

        $response->assertStatus(200);

        $response->assertValid(['search', 'direction']);

        $this->assertCount($numberOfPaginate, $response['data']);

    }

    public function test_posts_search_direction_is_empyt_return_desc(): void
    {
        $this->seed(CategoriesSeeder::class);

        $numberOfPaginate = 6;

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        Post::factory(10)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.search', ['search' => 'AUTHOR_TEST_NAME', 'direction' => '']));

        $response->assertStatus(200);

        $response->assertValid(['search', 'direction']);

        $this->assertCount($numberOfPaginate, $response['data']);

    }

    public function test_posts_search_by_title(): void
    {
        $this->seed(CategoriesSeeder::class);

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        $posts = Post::factory(10)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.search', ['search' => $posts[0]->title, 'direction' => 'desc']));

        $response->assertStatus(200);

        $this->assertCount(1, $response['data']);

    }

    public function test_posts_search_by_content(): void
    {
        $this->seed(CategoriesSeeder::class);

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        $posts = Post::factory(10)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.search', ['search' => $posts[0]->content, 'direction' => 'desc']));

        $response->assertStatus(200);

        $this->assertCount(1, $response['data']);
    }

    public function test_posts_search_by_author(): void
    {
        $this->seed(CategoriesSeeder::class);

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        $posts = Post::factory(1)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.search', ['search' => $posts[0]->author->name, 'direction' => 'desc']));

        $response->assertStatus(200);

    }

    public function test_posts_search_not_found(): void
    {
        $this->seed(CategoriesSeeder::class);

        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $categories = Category::all();

        Post::factory(10)->hasAttached($categories)->for($author)->create();

        $response = $this->getJson(route('posts.search', ['search' => 'INVALID TITLE', 'direction' => 'desc']));

        $response->assertStatus(200);

        $this->assertCount(0, $response['data']);

    }
}