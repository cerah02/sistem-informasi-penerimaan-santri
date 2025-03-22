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
        Schema::create('table_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
            $table->foreignId('ujian_id')->constrained('ujians')->onDelete('cascade');
            $table->integer('jumlah_soal');
            $table->integer('jawaban_benar');
            $table->integer('jawaban_salah');
            $table->decimal('nilai_akhir');
            $table->enum('status_lulus', ['Lulus', 'Tidak Lulus']);
            $table->text('keterangan')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_hasils');
    }
};
