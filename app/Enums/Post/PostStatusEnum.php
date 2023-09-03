<?php

namespace App\Enums\Post;

enum PostStatusEnum: string
{
    case PUBLISH = 'publish';
    case DRAFT = 'draft';
    case PRIVATE = 'private';
}