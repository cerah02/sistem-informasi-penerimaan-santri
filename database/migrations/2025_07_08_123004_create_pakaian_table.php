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
        Schema::create('pakaian', function (Blueprint $table) {
            $table->id();
            $table->string("nama_pakaian", 25);
            $table->string("foto_pakaian", 150);
            $table->enum("jenis_kelamin", ["laki-laki", "perempuan"])->nullable();
            $table->enum("jenjang_pendidikan", ["SD", "MTS", "MA"])->nullable();
            $table->string("keterangan");
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
        Schema::dropIfExists('pakaian');
    }
};
