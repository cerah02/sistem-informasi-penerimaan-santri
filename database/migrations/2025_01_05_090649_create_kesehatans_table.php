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
                $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
                $table->enum('golongan_darah',["A","B","AB","O"]);
                $table->integer('tb');
                $table->integer('bb');
                $table->string('riwayat_penyakit',50)->nullable();
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
