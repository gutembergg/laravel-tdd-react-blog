<?php

namespace App\Http\Controllers\Posts\Web;

use App\Actions\Post\RegisterPost;
use App\Actions\Post\UploadImages;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(PostStoreRequest $request): RedirectResponse
    {
     
        $post = (new RegisterPost())->handle($request);
        $image = (new UploadImages())->handle($request);
        
        $image->post()->associate($post);
        $image->save();

        return redirect()->back();
    }
}