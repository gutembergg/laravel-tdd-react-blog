<?php

namespace App\Actions\Post;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Author;
use App\Models\Post;

class RegisterPost
{
    public function handle(PostStoreRequest $request): Post
    {
        $post = new Post();
        $user = auth()->user();
        $newAuthor = null;

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = $post->title;
        $post->link = $post->title;

        $author = Author::where('user_id', $user->id)->first();

        if (! $author) {
            $newAuthor = Author::create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);
        }

        $post->author()->associate($author ? $author : $newAuthor);

        $post->save();
        $post->categories()->sync($request->input('categories'));

        return $post;
    }
}
