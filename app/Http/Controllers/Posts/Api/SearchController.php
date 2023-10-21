<?php

namespace App\Http\Controllers\Posts\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\SearchRequest;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{

    public function __invoke(SearchRequest $request): AnonymousResourceCollection
    {
        $posts = Post::postsSearch($request);

        return PostResource::collection($posts);
    }
}