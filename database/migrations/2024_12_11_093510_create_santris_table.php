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
            $table->string("nama",50);
            $table->string('nisn',10)->nullable();
            $table->string('nik',16)->nullable();
            $table->string('asal_sekolah',50)->nullable();
            $table->enum("jenis_kelamin",["laki-laki","perempuan"])->nullable();
            $table->string('ttl',30)->nullable();
            $table->enum('kondisi',["Berkecukupan", "Kurang Mampu"])->nullable();
            $table->enum('kondisi_ortu',["Lengkap","Yatim","Piatu","Yatim Piatu"])->nullable();
            $table->enum('status_dkluarga',["Anak Kandung", "Anak Tiri Dari Ayah","Anak Tiri Dari Ibu","Anak Angkat"])->nullable();
            $table->string('tempat_tinggal',30)->nullable();
            $table->string('kewarganegaraan',30)->nullable();
            $table->string('anak_ke',2)->nullable();
            $table->string("jumlah_saudara",2)->nullable();
            $table->string("alamat",50)->nullable();
            $table->bigInteger("nomor_telpon")->nullable();
            $table->string("email",50)->nullable();
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
