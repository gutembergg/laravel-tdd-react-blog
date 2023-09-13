<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role\RoleEnum;
use App\Models\Author;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $editorRole = Role::findByName(RoleEnum::EDITOR->value);

        /**
         * Creation de user editor author and posts
         */
        User::factory(9)
            ->create()
            ->each(
                fn (User $user) => $user->assignRole($editorRole)
            )->each(fn (User $user) => Author::factory()->has(Post::factory(5))->create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]));

        /**
         * Creation de user admin with posts
         */
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
        ])->assignRole(Role::findByName(RoleEnum::SUPER_ADMIN->value));

        $author = Author::factory()->create([
            'name' => $superAdmin->name,
            'user_id' => $superAdmin->name,
        ]);

        Post::factory(5)->create([
            'author_id' => $author->id,
        ]);
    }
}
