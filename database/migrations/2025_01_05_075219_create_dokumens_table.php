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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
            $table->string('akta_kelahiran');
            $table->string('ijazah')->nullable();;
            $table->string('nilai_raport')->nullable();;
            $table->string('skhun')->nullable();;
            $table->string('foto');
            $table->string('kk');
            $table->string('ktp_ayah');
            $table->string('ktp_ibu');
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
        Schema::dropIfExists('dokumens');
    }
};
