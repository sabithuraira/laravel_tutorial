<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id(); // sebuah kolom id dengan tipe AUTO INCREMENT dan PRIMARY KEY

            $table->string('nip');
            $table->string('nama');
            $table->integer('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('gelar')->nullable();

            $table->timestamps(); // created_at dan upated_at (berisi informasi kapan suatu data dibuat dan di modifikasi)
            //tipe dari timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
