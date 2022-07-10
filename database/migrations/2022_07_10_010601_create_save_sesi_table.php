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
        Schema::create('save_sesi', function (Blueprint $table) {
            $table->bigInteger('no_online');
            $table->string('no_test');
            $table->string('path_buktiregis');
            $table->string('sts_upl_bukti_regis');
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
        Schema::dropIfExists('save_sesi');
    }
};
