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
        Schema::dropIfExists('notifications');

        Schema::create('notifications', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type');
            $table->morphs('notifiable'); // membuat kolom notifiable_type dan notifiable_id
            $table->text('data');
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('notifications_table_fix');
    }
};
