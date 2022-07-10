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
        Schema::create('mhs_mf', function (Blueprint $table) {
            $table->string('nim');
            $table->string('nama_mhs');
            $table->string('no_test');
            $table->string('alamat_mhs');
            $table->integer('sex');
            $table->string('kota_mhs');
            $table->string('jalur_masuk');
            $table->string('thn_masuk');
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
        Schema::dropIfExists('mhs_mf');
    }
};
