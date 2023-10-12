<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Responsable;

class GetByUser
{
    public function handle(string $direction, int $sizeList): Collection|Responsable
    {
        $user = auth()->user();

        if (! $user) {
            return abort(402);
        }

        $posts = Post::whereHas('author', function (Builder $query) use ($user) {
            return $query->where('user_id', $user->id);
        })->with('medias', 'categories')->lastPosts($direction, $sizeList);

        return $posts;

    }
}