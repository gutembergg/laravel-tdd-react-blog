<?php

namespace App\Http\Controllers\Posts\Web;

use App\Actions\Post\GetByUser;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $categories = Category::all();
        $posts = (new GetByUser())->handle('desc', 4);

        return view('admin.index', ['categories' => $categories, 'posts' => $posts]);
    }
}
