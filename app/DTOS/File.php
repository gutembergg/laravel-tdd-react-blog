<?php

namespace App\DTOS;

class File
{
    public function __construct(
        public readonly string $name,
        public readonly string $originalName,
        public readonly string $mime,
        public readonly string $path,
        public readonly string $disk,
        public readonly string $hash,
        public readonly ?string $collection,
        public readonly ?int $size,

    ) {
    }

    /**
     * Undocumented function
     *
     * @return array<string, int|string|null>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'file_name' => $this->originalName,
            'mime_type' => $this->mime,
            'path' => $this->path,
            'disk' => $this->disk,
            'file_hash' => $this->hash,
            'collection' => $this->collection,
            'size' => $this->size,
        ];
    }
}