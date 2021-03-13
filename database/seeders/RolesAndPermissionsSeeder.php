<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'create quizzes']);
        Permission::create(['name' => 'edit quizzes']);
        Permission::create(['name' => 'delete quizzes']);
        Permission::create(['name' => 'take quizzes']);
        Permission::create(['name' => 'view quizzes']);
        Permission::create(['name' => 'view quiz questions']);
        // create roles and assign created permissions

        // Administrator
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo(Permission::all());

        //user
        $role = Role::create(['name' => 'user'])
            ->givePermissionTo(['take quizzes', 'view quiz questions', 'view quizzes']);
        //user
        $role = Role::create(['name' => 'restricted_user'])
            ->givePermissionTo(['view quiz questions', 'view quizzes']);
    }
}
