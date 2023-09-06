<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'status'
    ];

    protected $casts = [
        'comment_status' => 'boolean',
    ];

    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => Str::slug(strtolower($this->title)),
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => route(
                'posts.show',
                [
                    'slug' => Str::slug(strtolower($this->title)),
                ]
            ),
        );
    }
}