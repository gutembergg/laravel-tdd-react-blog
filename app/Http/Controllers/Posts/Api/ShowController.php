<?php

namespace App\Http\Controllers\Posts\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Request $request): Post|JsonResponse
    {
        $postQuery = Post::query();
        $post = $postQuery->where('slug', $request->slug)->with('author')->get()->first();

        if (! $post) {
            return response()->json([
                'error' => true,
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json($post);
    }
}
