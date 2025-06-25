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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            $table->string("nama",50);
            $table->bigInteger("nip")->nullable();
            $table->enum("jenis_kelamin",['Laki-laki','Perempuan']);
            $table->string("ttl",30);
            $table->string("alamat",50);
            $table->bigInteger("no_telpon");
            $table->string("email",50);
            $table->string("foto",150);
            $table->string("status_guru",10);
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
