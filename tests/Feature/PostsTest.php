<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostsTest extends TestCase
{
   
    use RefreshDatabase;

    public function test_posts_index_route(): void
    {
        $posts = Post::factory(10)->create();

        $response = $this->get(route('posts.index'));

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
                ->where('0.title', $post->title)
                ->where('0.slug', $post->slug)
                ->where('0.content', $post->content)
                ->where('0.link', $post->link)
                ->where('0.comment_status', $post->comment_status)

        );
    }
}