<?php

namespace App\Http\Controllers\Posts\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(PostStoreRequest $request): RedirectResponse
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

        return redirect()->back();
    }
}