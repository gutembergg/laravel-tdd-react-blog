<?php

namespace App\QueryBuilders\Post;

use App\Http\Requests\Post\SearchRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostQueryBuilder extends Builder
{
    public function lastPosts(string $direction, int $sizeList): Collection
    {
        $posts = Post::query();

        return $posts->orderBy('created_at', $direction)->take($sizeList)->get();
    }

    public function postsSearch(SearchRequest $request): LengthAwarePaginator
    {
        $query = Post::query();
        $direction = $request->validated('direction') ? $request->validated('direction') : 'desc';

        return $query
            ->with('author', 'categories', 'medias')
            ->orderBy('created_at', $direction)
            ->whereHas('author', function (Builder $author) use ($request) {
                $author->where('name', 'LIKE', '%'.$request->input('search').'%');
            })
            ->orWhere(function (Builder $query) use ($request) {
                $query->where('title', 'LIKE', '%'.$request->validated('search').'%')
                    ->orWhere('content', 'LIKE', '%'.$request->validated('search').'%');
            })
            ->paginate(6);

    }
}