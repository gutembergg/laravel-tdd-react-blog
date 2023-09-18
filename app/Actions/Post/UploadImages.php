<?php

namespace App\Actions\Post;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Media;

class UploadImages {

    public function handle(PostStoreRequest $request)
    {
        $media = $request->file('media');

        dd($media);
        $name = $media->hashName();

        $path = $media->storeAs('medias', $name);

       /*  $file = Media::create([
            'name' => "{$name}",
            'file_name' => $media->getClientOriginalName(),
            'mime_type' => $media->getClientMimeType(),
            'path' => $path,
            'disk' => config('uploads.disk'),
            'file_hash' => hash_file(config('uploads.algo'), 'medias/' . $name),
            'collection' => 'Posts',
            'size' => $media->getSize(),
        ]);

        dd($file); */
    }
}