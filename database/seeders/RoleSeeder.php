<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'tutor']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'client']);
    }
}
