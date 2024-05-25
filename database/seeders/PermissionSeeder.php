<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::updateOrCreate(['name' => 'admin']);
        $roleKaprodi = Role::updateOrCreate(['name' => 'kaprodi']);
        $roleDosen = Role::updateOrCreate(['name' => 'dosen']);

        $permissionAdmin = Permission::updateOrCreate(['name' => 'view_dashboard']);
        $permissionKaprodi = Permission::updateOrCreate(['name' => 'view_kurikulum']);
        $permissionDosen = Permission::updateOrCreate(['name' => 'view_mata_kuliah']);

        $roleAdmin->givePermissionTo($permissionAdmin);
        $roleKaprodi->givePermissionTo($permissionKaprodi);
        $roleDosen->givePermissionTo($permissionDosen);

        $userDosen = User::find(1);
        $userDosen->assignRole('dosen');

        $userKaprodi = User::find(2);
        $userKaprodi->assignRole('kaprodi');

        $userAdmin = User::find(3);
        $userAdmin->assignRole('admin');
    }
}
