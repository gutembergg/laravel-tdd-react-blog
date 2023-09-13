<?php

namespace App\Enums\Role;

enum RoleEnum: string
{
    case USER = 'user';
    case EDITOR = 'editor';
    case SUPER_ADMIN = 'Super Admin';
}
