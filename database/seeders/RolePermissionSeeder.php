<?php

namespace Database\Seeders;

use App\Enums\JenisKelamin;
use App\Enums\StatusKeaktifan;
use App\Models\Master_04_Dosen;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin_role = Role::create(['name' => 'admin']);
        $kaprodi_role = Role::create(['name' => 'koordinator program studi']);
        $dosen_role = Role::create(['name' => 'dosen']);

        Permission::create(['name' => 'view dashboard admin']);
        Permission::create(['name' => 'view dashboard kaprodi']);
        Permission::create(['name' => 'view dashboard dosen']);

        $admin_role->givePermissionTo('view dashboard admin');
        $kaprodi_role->givePermissionTo('view dashboard kaprodi');
        $dosen_role->givePermissionTo('view dashboard dosen');

        $admin = Master_04_Dosen::create([
            'kode' => 'ADM001',
            'nip' => '197501012012011001',
            'nama' => 'Admin',
            'email' => 'admin@polban.ac.id',
            'kata_sandi' => '$2a$12$IjSWBhJPaEi63eBrOJO8Z.DWXjFCko9Z4JakJEha7s32vctaQsl5W',
            'jenis_kelamin' => JenisKelamin::LakiLaki,
            'status' => StatusKeaktifan::Aktif
        ]);

        $admin->assignRole('admin');

        $general_permission = [
            'view dosen',
            'add dosen',
            'import dosen',
            'edit dosen',
            'view mahasiswa',
            'add mahasiswa',
            'import mahasiswa',
            'edit mahasiswa',
        ];

        $admin_permissions = [
            'view dashboard admin',
            'view jurusan',
            'add jurusan',
            'edit jurusan',
        ];

        $kaprodi_permissions = [
            'view dashboard kaprodi',
            'view kurikulum',
            'add kurikulum',
            'edit kurikulum',
            'view cpl',
            'add cpl',
            'import cpl',
            'edit cpl',
            'delete cpl',
            'view ik',
            'add ik',
            'import ik',
            'edit ik',
            'delete ik',
            'view tp',
            'validate tp',
            'view mk',
            'add mk',
            'import mk',
            'edit mk',
            'delete mk',
        ];

        $dosen_permissions = [
            'view mk',
            'view ik',
            'view tp',
            'add tp',
            'edit tp',
            'delete tp',
        ];
    }
}
