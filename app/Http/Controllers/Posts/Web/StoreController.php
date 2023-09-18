<?php

namespace App\Http\Controllers\Posts\Web;

use App\Actions\Post\RegisterPost;
use App\Actions\Post\UploadImages;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(PostStoreRequest $request): RedirectResponse
    {
     
        $post = (new RegisterPost())->handle($request);

        $iames = (new UploadImages())->handle($request);

        return redirect()->back();
    }
}