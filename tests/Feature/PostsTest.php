<?php

namespace Tests\Feature;

use App\Enums\Role\RoleEnum;
use App\Models\Author;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_index_route(): void
    {
       $expectedResponseSize = 8;

       $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $posts = Post::factory(10)->for($author)->create();

        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200);

        $this->assertCount($expectedResponseSize, $response['data']);
        
        $post = $posts->first();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->first(fn (AssertableJson $json) => 
                $json->whereAll([
                    '0.title' => $post->title,
                    '0.slug' => $post->slug,
                    '0.content' => $post->content,
                    '0.link' => $post->link,
                    '0.comment_status' => $post->comment_status,
                ])
                ->hasAll(['0.title', '0.slug', '0.content', '0.link', '0.comment_status', '0.author'])->etc()
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
        $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $post = Post::factory(1)->for($author)->createOne();

        $response = $this->getJson(route('posts.show', ['slug' => $post->slug]));

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['title', 'slug', 'content', 'link', 'comment_status', 'author_id'])->etc()
            ->whereAllType([
                'title' => 'string',
                'slug' => 'string',
                'content' => 'string',
                'link' => 'string',
                'comment_status' => 'boolean',
                'author_id' => 'integer'
            ])
            ->whereAll([
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'link' => $post->link,
                'comment_status' => $post->comment_status,
                'author_id' => $post->author_id
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
                'message' => 'string'
            ])
            ->whereAll([
                'error' => true,
                'message' => 'Post not found',
            ])
        );
    }

    public function test_posts_store_route(): void
    {
        $this->seed(RoleSeeder::class);
        
        $post = new Post();

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::EDITOR->value])
        );

        $post->title = 'TEST TITLE ONE';
        $post->content = fake()->paragraph();
        $post->slug = $slug = $post::slug($post->title);
        $post->link = $link = $post::link($post->title);
        $post->author_id = $authorId = $user->id;

        $response = $this->actingAs($user)->postJson(route('posts.store', [
            'title' => $post->title,
            'content' => $post->content,
            'slug' => $slug,
            'link' => $link,
            'author_id' => $authorId
        ]));

        $response->assertRedirect();

        $insertedPost = Post::first();
        $this->assertEquals($insertedPost->title, $post->title);
        $this->assertEquals($insertedPost->content, $post->content);
        $this->assertEquals($insertedPost->slug, $post->slug);
        $this->assertEquals($insertedPost->link, $post->link);
        $this->assertEquals($insertedPost->author_id, $post->author_id);
   
    }
}