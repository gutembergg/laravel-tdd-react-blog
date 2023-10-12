<?php

namespace App\Http\Controllers\Posts\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResource
    {
        $posts = Post::with('author', 'categories', 'medias')->orderBy('created_at', 'desc')->limit(8)->get();

        return PostResource::collection($posts);
    }
}