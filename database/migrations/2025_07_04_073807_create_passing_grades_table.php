<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('passing_grades', function (Blueprint $table) {
            $table->id();
            $table->string('jenjang')->unique();
            $table->integer('passing_grade')->default(70); // Default nilai awal
            $table->timestamps();
        });

        // Insert default data
        DB::table('passing_grades')->insert([
            ['jenjang' => 'SD', 'passing_grade' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['jenjang' => 'MTS', 'passing_grade' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['jenjang' => 'MA', 'passing_grade' => 70, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passing_grades');
    }
};
