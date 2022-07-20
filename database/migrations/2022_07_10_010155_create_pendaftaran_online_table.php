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
            $table->integer('no_online');
            $table->string('alamat_mhs');
            $table->string('kota_mhs');
            $table->string('email');
            $table->string('nama_ortu');
            $table->string('hp_ortu');
            $table->string('tahun_lulusan');
            $table->string('id_jalur');
            $table->string('kota_sma');
            $table->string('asal_sma');
            $table->string('jur_sma');
            $table->string('pil1');
            $table->string('pil2');
            $table->string('path_bayar')->nullable();
            $table->string('path_kartu')->nullable();
            $table->string('path_hasil')->nullable();
            $table->string('path_rapor')->nullable();
            $table->string('path_foto')->nullable();
            $table->string('no_test')->nullable();
            // $table->string('nama_mhs');
            // $table->char('jenis_kel');
            // $table->string('tempat_lahir');
            // $table->date('tgl_lahir');
            // $table->char('wn');
            // $table->char('agama');
            // $table->string('alamat_mhs');
            // $table->string('kota_mhs');
            // $table->string('pos_mhs');
            // $table->string('telp_mhs');
            // $table->string('hp_mhs');
            // $table->string('email');
            // $table->string('nama_ortu');
            // $table->string('alamat_ortu');
            // $table->string('kota_ortu');
            // $table->string('pos_ortu');
            // $table->string('telp_ortu');
            // $table->string('hp_ortu');
            // $table->string('pendidikan_ortu');
            // $table->string('pekerjaan_ortu');
            // $table->string('jabatan_ortu');
            // $table->string('asal_sma');
            // $table->string('jur_sma');
            // $table->string('kota_sma');
            // $table->string('kota_sma');
            // $table->string('pil1');
            // $table->string('pil2');
            // $table->string('alasan_masuk');
            // $table->string('informasi_masuk');
            // $table->string('prestasi_akademik');
            // $table->string('prestasi_nonakademik');
            // $table->string('pt_lain');
            // $table->string('path_foto');
            // $table->string('path_rapor');
            // $table->date('tgl_daftar');
            // $table->string('atas_nama');
            // $table->string('norek');
            // $table->integer('jumlah_bayar');
            // $table->string('path_bayar');
            // $table->string('no_test');
            // $table->string('path_stmd');
            // $table->string('path_paspor');
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
