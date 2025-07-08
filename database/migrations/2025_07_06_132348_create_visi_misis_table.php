<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        // Data default
        DB::table('visi_misis')->insert([
            ['key' => 'visi', 'value' => 'Mencetak Kader Bangsa Yang Berlandaskan Wawasan Dan Pengetahuan Ke-islaman'],
            ['key' => 'quote', 'value' => '"Sebaik-baik kalian adalah yang mempelajari Al-Qur\'an dan mengajarkannya" <br><strong>(HR. Bukhari)</strong>'],
            ['key' => 'misi', 'value' => json_encode([
                'Membentuk pribadi muslim yang berbekal ilmu pengetahuan dan teknologi yang disertai dengan iman dan takwa.',
                'Mengimplementasikan serta mengamalkan nilai-nilai yang terkandung dalam kitab suci Al-Qur\'an dan sunnah Rasulullah SAW.',
            ])],
            ['key' => 'nilai', 'value' => json_encode([
                [
                    'icon' => 'fas fa-quran',
                    'title' => "Qur'ani",
                    'desc' => 'Al-Qur\'an sebagai pedoman utama dalam kehidupan'
                ],
                [
                    'icon' => 'fas fa-hands-helping',
                    'title' => 'Akhlak Mulia',
                    'desc' => 'Meneladani akhlak Rasulullah SAW dalam kehidupan sehari-hari'
                ],
                [
                    'icon' => 'fas fa-lightbulb',
                    'title' => 'Ilmu Bermanfaat',
                    'desc' => 'Mencari ilmu yang bermanfaat untuk dunia dan akhirat'
                ],
                [
                    'icon' => 'fas fa-users',
                    'title' => 'Ukhuwah Islamiyah',
                    'desc' => 'Mempererat persaudaraan sesama muslim'
                ],
            ])],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misis');
    }
};
