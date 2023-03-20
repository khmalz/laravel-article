<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user_access',
            'article_access',
            'article_create',
            'article_show',
            'article_edit',
            'article_delete',
            'category_access',
            'category_create',
            'category_show',
            'category_edit',
            'category_delete',
            'tag_access',
            'tag_create',
            'tag_show',
            'tag_edit',
            'tag_delete',
        ];

        $adminPermissions = [
            'user_access',
            'article_show',
            'category_access',
            'category_create',
            'category_show',
            'category_edit',
            'category_delete',
            'tag_access',
            'tag_create',
            'tag_show',
            'tag_edit',
            'tag_delete',
        ];

        $userPermissions = [
            'user_access',
            'article_access',
            'article_create',
            'article_show',
            'article_edit',
            'article_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        Role::create(['name' => 'Super Admin']);

        $role = Role::create(['name' => 'Admin']);

        foreach ($adminPermissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $role = Role::create(['name' => 'User']);

        foreach ($userPermissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}