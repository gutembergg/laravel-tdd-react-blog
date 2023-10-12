<?php

namespace App\Actions\Post;

use App\DTOS\File;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Media;

class UploadImages
{
    public function handle(PostStoreRequest $request): Media | null
    {
        $media = $request->file('media');

        if ($media === null || $media->getError()) {
            return null;
        }

        $name = $media->hashName();

        $path = $media->store('medias', 'public');

        $file = new File(
            name: "{$name}",
            originalName: $media->getClientOriginalName(),
            mime: $media->getClientMimeType(),
            path: $path,
            disk: config('uploads.disk'),
            hash: hash(config('uploads.algo'),
                storage_path(
                    path: "app/medias/{$name}",
                )),
            collection: 'posts',
            size: $media->getSize(),
        );
        $image = Media::create(attributes: $file->toArray());

        return $image;

    }
}