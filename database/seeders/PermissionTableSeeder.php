<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'santri-list',
            'santri-create',
            'santri-edit',
            'santri-delete',
            'guru-list',
            'guru-create',
            'guru-edit',
            'guru-delete',
            'soal-create',
            'soal-edit',
            'soal-show',
            'soal-delete',
            'soal-list',
            'jawaban-list',
            'dokumen-list',
            'dokumen-create',
            'dokumen-edit',
            'dokumen-show',
            'ortu-list',
            'kesehatan-list',
            'bantuan-list',
            'ujian-create',
            'ujian-edit',
            'ujian-show',
            'ujian-delete',
            'ujian-list',
            'user-list',
            'user-create',
            'user-show',
            'user-delete',
            'pendaftaran-create',
            'pendaftaran-list',
            'pendaftaran-show',
            'pendaftaran-edit',
            'waktu_ujian-list'

        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
