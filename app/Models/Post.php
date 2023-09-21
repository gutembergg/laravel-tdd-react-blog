<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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


  /*   public static function boot()
    {
        parent::boot();
 
        static::creating(function($model) {
            $model->slug = Str::slug($model->title);// change the ToBeSluggiefied

 
            $latestSlug =
                static::whereRaw("slug = '$model->slug' or slug LIKE '$model->slug-%'")
                    ->latest('id')
                    ->value('slug');

                    dd( $latestSlug );
            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);
 
                $number = intval(end($pieces));
 
                $model->slug .= '-' . ($number + 1);

            }
        });
    }
 */
    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => Str::slug(strtolower($value)),
        );
    } 


    public static function link(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => route(
                'posts.show',
                [
                    'slug' => Str::slug(strtolower($value)),
                ]
            ),
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

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }
}