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
        Schema::create('ortus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
            $table->string('nama_ayah',50);
            $table->string('pendidikan_ayah',30);
            $table->string('pekerjaan_ayah',30);
            $table->string('nama_ibu',50);
            $table->string('pendidikan_ibu',30);
            $table->string('pekerjaan_ibu',30);
            $table->bigInteger('no_hp');
            $table->string('alamat_ortu');
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
        Schema::dropIfExists('ortus');
    }
};
