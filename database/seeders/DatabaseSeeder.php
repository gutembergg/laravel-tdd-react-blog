<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role\RoleEnum;
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
        
        User::factory(9)
            ->create()
            ->each(
                fn (User $user) => $user->assignRole($editorRole)
            )->each(fn (User $user) => Post::factory()->create([
                'author_id' => $user->id
            ]));


        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
        ])->assignRole(Role::findByName(RoleEnum::SUPER_ADMIN->value));

        Post::factory()->create([
            'author_id' => $superAdmin->id
        ]);
    }
}