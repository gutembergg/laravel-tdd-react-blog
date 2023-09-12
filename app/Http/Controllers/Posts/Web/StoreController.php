<?php

namespace App\Http\Controllers\Posts\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(PostStoreRequest $request)
    {
        $post = new Post();
        $user = auth()->user();

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Post::slug($post->title);
        $post->link = Post::link($post->title);
        $post->author()->associate($user);
        $post->save();

        //return $post;
    }
}