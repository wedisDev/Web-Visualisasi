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
        Schema::create('smu_mf', function (Blueprint $table) {
            $table->string('id_smu')->primary();
            $table->string('nama_smu');
            $table->string('alamat_smu');
            $table->string('kota_id');
            $table->string('tipe_smu');
            $table->string('status_smu');
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
        Schema::dropIfExists('smu_mf');
    }
};
