<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(random_int(1, 8), true);

        return [
         /*    'name' => $name,
            'file_name' => fake()->word(),
            'mime_type' => $this->mime,
            'path' => fake()->imageUrl(),
            'disk' => 'local',
            'file_hash' => $this->hash,
            'collection' => $this->collection,
            'size' => $this->size,, */
        ];
    }
}

/* name: "{$name}",
originalName: $media->getClientOriginalName(),
mime: $media->getClientMimeType(),
path: $path,
disk: config('uploads.disk'),
hash: hash(config('uploads.algo'),
    storage_path(
        path: "app/medias/{$name}",
    )),
collection: 'posts',
size: $media->getSize(), */