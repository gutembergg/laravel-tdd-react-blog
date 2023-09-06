<?php

use App\Enums\Post\PostStatusEnum;
use App\Models\Author;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('link');
            $table->string('status')->default(PostStatusEnum::PUBLISH->value);
            $table->string('slug')->unique();
            $table->boolean('comment_status')->default(false);
            $table->integer('author_id')->nullable()->unsigned()->constrained()->onDelete('cascade');

            //$table->foreignIdFor(Author::class)->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};