<?php

namespace App\QueryBuilders\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AdminLastPostsBuilder extends Builder 
{
    public function lastPosts(string $direction, int $sizeList): Collection
    {
        $posts = Post::query();
        return $posts->orderBy('created_at', $direction)->take($sizeList)->get();
    }
}