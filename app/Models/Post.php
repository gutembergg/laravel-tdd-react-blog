<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'status',
    ];

    protected $casts = [
        'comment_status' => 'boolean',
    ];

    /* static function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => Str::slug(strtolower($this->title)),
        );
    } */

    public static function slug(string $title): string
    {
        return Str::slug(strtolower($title));
    }

    public static function link(string $title): string
    {
        return route(
            'posts.show',
            [
                'slug' => self::slug($title),
            ]
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
