<?php

namespace App\Http\Controllers\Posts\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateUpdateController extends Controller
{
    public function store(PostStoreRequest $request): void
    {
        dd($request);
    }
}