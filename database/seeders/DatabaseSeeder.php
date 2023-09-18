<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role\RoleEnum;
use App\Models\Author;
use App\Models\Category;
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
        $this->call(CategoriesSeeder::class);

        /**
         * Creation de user editor author and posts
         */
        $editorRole = Role::findByName(RoleEnum::EDITOR->value);
        $categories = Category::all();

        User::factory(9)
            ->create()
            ->each(
                fn (User $user) => $user->assignRole($editorRole)
            )
            ->each(fn (User $user) => Author::factory()
                ->has(Post::factory()
                ->count(5)
                ->hasAttached($categories->random(2)))
                ->create([
                    'name' => $user->name,
                    'user_id' => $user->id,
            ])
            );

        /**
         * Creation de user admin with posts
         */
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
        ])->assignRole(Role::findByName(RoleEnum::SUPER_ADMIN->value));

        Author::factory()->has(Post::factory()
            ->count(5)
            ->hasAttached($categories->random(2)))
            ->create([
                'name' => $superAdmin->name,
                'user_id' => $superAdmin->id,
        ]);

    }
}