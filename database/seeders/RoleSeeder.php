<?php

namespace Database\Seeders;

use App\Enums\Role\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $roleEnum) {
            Role::create([
                'name' => $roleEnum->value,
            ]);
        }

        (Permission::create(['name' => 'posts.*']))
            ->assignRole(Role::findByName(RoleEnum::EDITOR->value));
    }
}
