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
            'role-show',
            'santri-list',
            'santri-create',
            'santri-edit',
            'santri-delete',
            'santri-show',
            'guru-list',
            'guru-create',
            'guru-edit',
            'guru-delete',
            'guru-show',
            'soal-list',
            'soal-create',
            'soal-edit',
            'soal-show',
            'soal-delete',
            'jawaban-list',
            'jawaban-create',
            'jawaban-edit',
            'jawaban-show',
            'jawaban-delet',
            'dokumen-list',
            'dokumen-create',
            'dokumen-edit',
            'dokumen-show',
            'dokumen-delete',
            'ortu-list',
            'ortu-create',
            'ortu-edit',
            'ortu-show',
            'ortu-delete',
            'kesehatan-list',
            'kesehatan-create',
            'kesehatan-edit',
            'kesehatan-delete',
            'kesehatan-show',
            'bantuan-list',
            'bantuan-create',
            'bantuan-edit',
            'bantuan-delete',
            'bantuan-show',
            'ujian-create',
            'ujian-edit',
            'ujian-show',
            'ujian-delete',
            'ujian-list',
            'user-list',
            'user-create',
            'user-show',
            'user-delete',
            'user-edit',
            'pendaftaran-list',
            'pendaftaran-create',
            'pendaftaran-show',
            'pendaftaran-delete',
            'pendaftaran-edit',
            'waktu_ujian-list',
            'waktu_ujian-create',
            'waktu_ujian-edit',
            'waktu_ujian-delete',
            'waktu_ujian-show',
            'agenda-list',
            'agenda-create',
            'agenda-edit',
            'agenda-delete',
            'agenda-show',
            'fasilitas-list',
            'fasilitas-create',
            'fasilitas-edit',
            'fasilitas-delete',
            'fasilitas-show',

        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
