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
        Schema::create('jurusan_smu', function (Blueprint $table) {
            $table->bigInteger('kd_jurusan')->primary();
            $table->string('nama_jurusan');
            $table->string('ket_jurusan');
            $table->string('tipe_jurusan');
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
        Schema::dropIfExists('jurusan_smu');
    }
};
