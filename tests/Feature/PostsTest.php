<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
   
    use RefreshDatabase;

    public function test_posts_index_route(): void
    {
        $posts = Post::factory(10)->create();

        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200);

        $response->assertJsonCount(8);

        $post = $posts->first();

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->hasAll(['0.title', '0.slug', '0.content', '0.link', '0.comment_status'])
                ->whereAllType([
                    '0.title' => 'string',
                    '0.slug' => 'string',
                    '0.content' => 'string',
                    '0.link' => 'string',
                    '0.comment_status' => 'boolean'
                ])
                ->whereAll([
                    '0.title' =>  $post->title,
                    '0.slug' => $post->slug,
                    '0.content' => $post->content,
                    '0.link' => $post->link,
                    '0.comment_status' => $post->comment_status
                ])
               

        );
    }

    public function test_posts_show_route(): void
    {
        $post = Post::factory(1)->createOne();

        $response = $this->getJson(route('posts.show', ['slug' => $post->slug]));

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->hasAll(['title', 'slug', 'content', 'link', 'comment_status'])->etc()
                ->whereAllType([
                    'title' => 'string',
                    'slug' => 'string',
                    'content' => 'string',
                    'link' => 'string',
                    'comment_status' => 'boolean'
                ])
                ->whereAll([
                    'title' =>  $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'link' => $post->link,
                    'comment_status' => $post->comment_status
                ])
               
        );
    }
}