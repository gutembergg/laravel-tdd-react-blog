<?php

namespace App\Services\Post;

use App\Actions\Post\RegisterPost;
use App\Actions\Post\UploadImages;
use App\Contracts\Post\StorePostContract;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;

class StoreService implements StorePostContract
{
    public function exec(PostStoreRequest $request): Post
    {
        $post = (new RegisterPost())->handle($request);
        $image = (new UploadImages())->handle($request);

        if ($image) {
            $image->post()->associate($post);
            $image->save();
        }

        return $post;

    }
}
