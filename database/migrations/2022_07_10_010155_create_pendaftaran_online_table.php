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
        Schema::create('pendaftaran_online', function (Blueprint $table) {
            $table->bigInteger('no_online');
            $table->string('nama_mhs');
            $table->string('alamat_mhs');
            $table->string('kota_mhs');
            $table->string('email');
            $table->string('nama_ortu');
            $table->string('hp_ortu');
            $table->string('tahun_lulusan');
            $table->string('kota_sma');
            $table->string('asal_sma');
            $table->string('jur_sma');
            $table->string('pil1');
            $table->string('pil2');
            $table->string('path_bayar');
            $table->string('path_kartu');
            $table->string('path_hasil');
            $table->string('path_rapor');
            $table->string('path_foto');
            $table->string('no_test');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_online');
    }
};
