<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Request $request): Post|JsonResponse
    {
        $post = Post::where('slug', $request->slug)->get()->first();

        if (! $post) {
            return response()->json([
                'error' => true,
                'message' => 'Post not found',
            ], 404);
        }

        return $post;
    }
}
