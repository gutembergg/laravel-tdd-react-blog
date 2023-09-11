<?php

namespace App\Http\Controllers\Posts\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostStoreRequest $request)
    {
        dd($request);
    }
}