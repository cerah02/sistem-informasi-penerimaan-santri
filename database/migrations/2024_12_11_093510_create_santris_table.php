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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            $table->string("nama");
            $table->bigInteger('nisn')->nullable();
            $table->bigInteger('nik')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->enum("jenis_kelamin",["laki-laki","perempuan"])->nullable();
            $table->string('ttl')->nullable();
            $table->enum('kondisi',["Berkecukupan", "Kurang Mampu"])->nullable();
            $table->enum('kondisi_ortu',["Lengkap","Yatim","Piatu","Yatim Piatu"])->nullable();
            $table->enum('status_dkluarga',["Anak Kandung", "Anak Tiri Dari Ayah","Anak Tiri Dari Ibu","Anak Angkat"])->nullable();
            $table->string('tempat_tinggal')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('anak_ke')->nullable();
            $table->integer("jumlah_saudara")->nullable();
            $table->string("alamat")->nullable();
            $table->string("nomor_telpon")->nullable();
            $table->string("email")->nullable();
            $table->enum("jenjang_pendidikan",["SD","MTS","MA"])->nullable();
            $table->year("tahun_masuk")->nullable();
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
