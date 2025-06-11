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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->string("nama_ujian",30);
            $table->string("kategori",30);
            $table->enum("jenjang_pendidikan",["SD","MTS","MA"]);
            $table->date("tanggal_mulai");
            $table->date("tanggal_selesai");
            $table->integer("durasi");
            // $table->enum("status", ["Belum Mulai", "Sedang Berlangsung", "Selesai"]);
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
        Schema::dropIfExists('ujians');
    }
};
