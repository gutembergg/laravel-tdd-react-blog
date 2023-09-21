<?php

namespace App\Http\Controllers\Posts\Web;

use App\Contracts\Post\StorePostContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __construct(private StorePostContract $service)
    {}

    public function __invoke(PostStoreRequest $request): RedirectResponse
    {
        
        $this->service->exec($request);

        return redirect()->back();
    }
}