<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteStandartLayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standart_layanan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bidang_layanan_id')->unsigned();
            $table->foreign('bidang_layanan_id')->references('id')->on('bidang_layanans');
            $table->string('nama');
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
        Schema::dropIfExists('standart_layanan');
    }
}
