<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
    // Event deleting untuk menghapus data terkait
    protected static function booted()
    {
        static::deleting(function ($pendaftaran) {
            // Cari santri yang terkait dengan pendaftaran
            $santri = $pendaftaran->santri;

            if ($santri) {
                // Hapus data terkait seperti dokumen, ortu, kesehatan, dan bantuan
                $santri->dokumen()->delete();
                $santri->ortu()->delete();
                $santri->kesehatan()->delete();
                $santri->bantuan()->delete();

                // Hapus santri itu sendiri jika diperlukan
                $santri->delete();
                // Hapus user yang terkait dengan santri (pastikan relasi 'user' ada di model Santri)
                $user = $santri->user;
                if ($user) {
                    $user->delete();
                }
            }
        });
    }
    public function user()
    {
        return $this->santri ? $this->santri->user : null;
    }
}
