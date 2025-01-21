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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->bigInteger("nip");
            $table->string("jenis_kelamin");
            $table->string("ttl");
            $table->string("alamat");
            $table->bigInteger("no_telpon");
            $table->string("email");
            $table->string("foto");
            $table->string("status_guru");
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
        Schema::dropIfExists('gurus');
    }
};
