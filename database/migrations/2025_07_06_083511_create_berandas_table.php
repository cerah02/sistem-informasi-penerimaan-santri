<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan DB facade

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('berandas', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        // 🚀 Isi data awal langsung setelah membuat tabel
        DB::table('berandas')->insert([
            [
                'key' => 'carousel_1_image',
                'value' => 'landing_assets/img/pondok_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'carousel_1_title',
                'value' => 'Pondok Pesantren Modern',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'carousel_1_description',
                'value' => 'Mendidik generasi muda dengan ilmu agama dan ilmu umum yang seimbang. Kami berkomitmen untuk menciptakan lingkungan belajar yang kondusif dan inspiratif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'carousel_2_image',
                'value' => 'landing_assets/img/pondok_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'carousel_2_title',
                'value' => 'Kegiatan Santri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'carousel_2_description',
                'value' => 'Santri kami terlibat dalam berbagai kegiatan yang mendukung perkembangan spiritual, intelektual, dan fisik. Mulai dari kajian kitab kuning, olahraga, hingga kegiatan seni.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('berandas');
    }
};
