<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul',50)->nullable();        // Judul pengumuman
            $table->text('konten')->nullable();         // Isi pengumuman (opsional)
            $table->date('tanggal_rilis');          // Waktu mulai ditampilkan
            $table->boolean('is_active')->default(false); // Status aktif atau tidak
            $table->timestamps();                       // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengumuman');
    }
};
