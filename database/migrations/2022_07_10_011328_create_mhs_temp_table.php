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
        Schema::create('mhs_temp', function (Blueprint $table) {
            $table->integer('no_online');
            $table->string('no_test');
            $table->string('nim');
            $table->string('jalur_masuk');
            $table->string('thn_masuk');
            $table->string('nama_mhs');
            $table->integer('sex');
            $table->string('pil1');
            $table->string('pil2');
            $table->string('kota_sma');
            $table->string('asal_sma');
            $table->string('jur_sma');
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
        Schema::dropIfExists('mhs_temp');
    }
};
