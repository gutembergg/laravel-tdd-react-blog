<?php

namespace App\Http\Controllers\Posts\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Request $request): PostResource|JsonResponse
    {
        $postQuery = Post::query();
        $post = $postQuery->where('slug', $request->slug)->with('author', 'categories', 'medias')->get()->first();

        if (! $post) {
            return response()->json([
                'error' => true,
                'message' => 'Post not found',
            ], 404);
        }

        return new PostResource($post);
    }
}
