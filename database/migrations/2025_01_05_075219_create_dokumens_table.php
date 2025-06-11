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
            $table->string('akta_kelahiran',150);
            $table->string('ijazah',150)->nullable();
            $table->string('nilai_raport',150)->nullable();
            $table->string('skhun',150)->nullable();
            $table->string('foto',150);
            $table->string('kk',150);
            $table->string('ktp_ayah',150);
            $table->string('ktp_ibu',150);
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
