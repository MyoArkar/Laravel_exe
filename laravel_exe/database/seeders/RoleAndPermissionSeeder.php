<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $dashboard = Permission::create(['name' => 'dashboard']);

        $articleList = Permission::create(['name' => 'articleList']);
        $articleCreate = Permission::create(['name' => 'articleCreate']);
        $articleEdit = Permission::create(['name' => 'articleEdit']);
        $articleDelete = Permission::create(['name' => 'articleDelete']);

        $categoryList = Permission::create(['name' => 'categoryList']);
        $categoryCreate = Permission::create(['name' => 'categoryCreate']);
        $categoryEdit = Permission::create(['name' => 'categoryEdit']);
        $categoryDelete = Permission::create(['name' => 'categoryDelete']);

        $userList = Permission::create(['name' => 'userList']);
        $userCreate = Permission::create(['name' => 'userCreate']);
        $userEdit = Permission::create(['name' => 'userEdit']);
        $userDelete = Permission::create(['name' => 'userDelete']);

        $admin->givePermissionTo([
            $dashboard,
            $categoryList,
            $categoryCreate,
            $categoryEdit,
            $categoryDelete,

            $userList,
            $userCreate,
            $userEdit,
            $userDelete,

            $articleList,
            $articleCreate,
            $articleEdit,
            $articleDelete,
        ]);

        $user->givePermissionTo([
            $categoryList
        ]);
    }
}
