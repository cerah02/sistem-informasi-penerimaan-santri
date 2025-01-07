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
        Schema::create('kesehatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('santri_id');
            $table->enum('golongan_darah',["A","B","AB","O"]);
            $table->integer('tb');
            $table->integer('bb');
            $table->string('riwayat_penyakit');
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
        Schema::dropIfExists('kesehatans');
    }
};
