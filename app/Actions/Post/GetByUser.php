<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetByUser {

    public function handle(): Collection | Responsable
    {
        $user = auth()->user();

        if(!$user) {
            return abort(402);
        }

        $posts = Post::whereHas('author', function (Builder $query) use($user) {
            $query->where('user_id', $user->id);
        })->get();

        return $posts;

    }

}