<?php

namespace App\Actions\Post;

use App\Models\Post;

class HandleUniqSlug {

    public function __invoke(string $slug): string | null
    {
        $slugPrefix = '-2';
        $query = Post::query();

        $hasSlug = $query->where('slug', $slug)->get('slug')->first();

        if(!$hasSlug) {
            return $slug;
        }

        return $hasSlug->slug . $slugPrefix;

    }
}