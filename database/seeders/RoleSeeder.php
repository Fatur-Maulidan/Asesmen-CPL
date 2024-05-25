<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $roleAdmin = Role::updateOrCreate(['name' => 'admin']);
        $roleKaprodi = Role::updateOrCreate(['name' => 'kaprodi']);
        $roleDosen = Role::updateOrCreate(['name' => 'dosen']);
    }
}
