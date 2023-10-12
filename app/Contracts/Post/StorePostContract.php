<?php

namespace App\Contracts\Post;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;

interface StorePostContract
{
    public function exec(PostStoreRequest $request): Post;
}
