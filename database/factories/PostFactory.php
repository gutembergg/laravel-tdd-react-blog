<?php

namespace Database\Factories;

use App\Enums\Post\PostStatusEnum;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(random_int(1, 8), true);
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'content' => fake()->text(),
            'link' => $slug,
            'status' => PostStatusEnum::PUBLISH->value,
            'comment_status' => false,
            'author_id' => Author::factory(),
        ];
    }
}
