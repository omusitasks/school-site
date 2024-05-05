<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('testing'),// password
        ]);

        $admin->assignRole('admin');

        // ROLES

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        //USERS

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);
        $permission = Permission::create(['name' => 'User update role']);

        // PERMISSIONS

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        // BLOG MODULE
        // BLOGS

        $permission = Permission::create(['name' => 'Blog access']);
        $permission = Permission::create(['name' => 'Blog edit']);
        $permission = Permission::create(['name' => 'Blog create']);
        $permission = Permission::create(['name' => 'Blog delete']);

        // TAGS

        $permission = Permission::create(['name' => 'Tag access']);
        $permission = Permission::create(['name' => 'Tag edit']);
        $permission = Permission::create(['name' => 'Tag create']);
        $permission = Permission::create(['name' => 'Tag delete']);

        // BLOG CATEGORIES

        $permission = Permission::create(['name' => 'BlogCategory access']);
        $permission = Permission::create(['name' => 'BlogCategory edit']);
        $permission = Permission::create(['name' => 'BlogCategory create']);
        $permission = Permission::create(['name' => 'BlogCategory delete']);

        // COURSE MODULE
        // COURSES

        $permission = Permission::create(['name' => 'Course access']);
        $permission = Permission::create(['name' => 'Course edit']);
        $permission = Permission::create(['name' => 'Course create']);
        $permission = Permission::create(['name' => 'Course delete']);

        // COURSE TYPES

        $permission = Permission::create(['name' => 'CourseType access']);
        $permission = Permission::create(['name' => 'CourseType edit']);
        $permission = Permission::create(['name' => 'CourseType create']);
        $permission = Permission::create(['name' => 'CourseType delete']);

        // COURSE CATEGORIES

        $permission = Permission::create(['name' => 'CourseCategory access']);
        $permission = Permission::create(['name' => 'CourseCategory edit']);
        $permission = Permission::create(['name' => 'CourseCategory create']);
        $permission = Permission::create(['name' => 'CourseCategory delete']);

        // PROJECTS MODULE
        // PROJECTS

        $permission = Permission::create(['name' => 'Project access']);
        $permission = Permission::create(['name' => 'Project edit']);
        $permission = Permission::create(['name' => 'Project create']);
        $permission = Permission::create(['name' => 'Project delete']);

        // PROJECT TYPES

        $permission = Permission::create(['name' => 'ProjectType access']);
        $permission = Permission::create(['name' => 'ProjectType edit']);
        $permission = Permission::create(['name' => 'ProjectType create']);
        $permission = Permission::create(['name' => 'ProjectType delete']);

        // PROJECT CATEGORIES

        $permission = Permission::create(['name' => 'ProjectCategory access']);
        $permission = Permission::create(['name' => 'ProjectCategory edit']);
        $permission = Permission::create(['name' => 'ProjectCategory create']);
        $permission = Permission::create(['name' => 'ProjectCategory delete']);

        // PROJECT STATUS

        $permission = Permission::create(['name' => 'ProjectStatus access']);
        $permission = Permission::create(['name' => 'ProjectStatus edit']);
        $permission = Permission::create(['name' => 'ProjectStatus create']);
        $permission = Permission::create(['name' => 'ProjectStatus delete']);


        $admin->givePermissionTo(Permission::all());
    }
}




