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
        Schema::create('total_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->unique()->constrained('santris')->onDelete('cascade');
            $table->float('rata_rata',3,2);
            $table->enum('status',['Lulus','Tidak Lulus']);
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
        Schema::dropIfExists('total_hasils');
    }
};
