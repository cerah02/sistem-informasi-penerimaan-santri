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
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->bigInteger('nisn');
            $table->bigInteger('nik');
            $table->string('asal_sekolah');
            $table->enum("jenis_kelamin",["laki-laki","perempuan"]);
            $table->string('ttl');
            $table->enum('kondisi',["Berkecukupan", "Kurang Mampu"]);
            $table->enum('kondisi_ortu',["Lengkap","Yatim","Piatu","Yatim Piatu"]);
            $table->enum('status_dkluarga',["Anak Kandung", "Anak Tiri Dari Ayah","Anak Tiri Dari Ibu","Anak Angkat"]);
            $table->string('tempat_tinggal');
            $table->string('kewarganegaraan');
            $table->string('anak_ke');
            $table->integer("jumlah_saudara");
            $table->string("alamat");
            $table->string("nomor_telpon");
            $table->string("email");
            $table->enum("jenjang_pendidikan",["SD","MTS","MA"]);
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
        Schema::dropIfExists('santris');
    }
};
