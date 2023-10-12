<?php

namespace App\Http\Controllers\Posts\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        $query = Post::query();
        $post = $query->where('slug', $request->slug)->with('categories')->first();

        if (! $post) {
            return back();
        }

        return view('admin.post-edit', ['post' => $post]);
    }
}
