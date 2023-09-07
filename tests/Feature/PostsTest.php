<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_index_route(): void
    {
       $author = Author::factory()->state([
            'name' => 'AUTHOR_TEST_NAME',
        ]);

        $posts = Post::factory(10)->for($author)->create();

        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200);

        $response->assertJsonCount(8);

        $post = $posts->first();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->first(fn (AssertableJson $json) =>
                $json->whereAll([
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'link' => $post->link,
                    'comment_status' => $post->comment_status,
                    'author_id' => $post->author_id
                ])
                ->hasAll(['title', 'slug', 'content', 'link', 'comment_status', 'author_id'])->etc()
                ->whereAllType([
                    'title' => 'string',
                    'slug' => 'string',
                    'content' => 'string',
                    'link' => 'string',
                    'comment_status' => 'boolean',
                    'author_id' => 'integer'
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
}